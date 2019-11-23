<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kriteria;
use App\KriteriaPeminatan;

class KriteriaController extends Controller
{

	public function createMenuTambahKriteria(){
		return view('waka_kurikulum.tambah_kriteria');
	}

	public function halamanKriteriaPeminatan(){
		$data_kriteria_peminatan = KriteriaPeminatan::select(
			'id',
			'kode_kriteria',
			'jumlah',
			DB::raw('DAY(created_at) AS day'),
			DB::raw('MONTH(created_at) AS month'),
			DB::raw('YEAR(created_at) AS year'),
			'status',
			'status_bobot'
			)
		->orderBy('created_at', 'desc')
		->get();
		return view('tim_ppdb.daftar_kriteria_peminatan', compact('data_kriteria_peminatan'));
	}

	public function buatKriteriaBaru(Request $data){
		$jumlah = $data->jumlah;
		return view('tim_ppdb.kriteria_peminatan_baru', compact('jumlah'));
	}

	public function storeKriteriaBaru(Request $data){
		$jumlah = count($data->kriteria);
		$cek_id = KriteriaPeminatan::select('id')->orderBy('id', 'desc')->limit(1)->first();
		$tanggal = getdate();

		// memasukkan data ke tabel kritera_peminatan
		if ($cek_id == NULL) {
			KriteriaPeminatan::create([
				'kode_kriteria' => "kriteria_1".substr($tanggal['year'], -2),
				'jumlah' => $jumlah
				]);
		} else {
			KriteriaPeminatan::create([
				'kode_kriteria' => "kriteria_".($cek_id->id+1)."".substr($tanggal['year'], -2),
				'jumlah' => $jumlah
				]);
		}

		// memasukkan data ke tabel kriteria
		$cek_id = KriteriaPeminatan::select('id')->orderBy('id', 'desc')->limit(1)->first();
		for ($i=0; $i < $jumlah; $i++) { 
			Kriteria::create([
				'id_kriteria_peminatan' => $cek_id->id,
				'kriteria'              => $data->kriteria[$i],
				'kategori'              => $data->kategori[$i],
				'klasifikasi_nilai'     => $data->klasifikasi_nilai[$i]
				]);
		}

		return redirect('/daftar_kriteria_peminatan/daftar_kriteria/'.$cek_id->id);
	}

	public function storeKriteria(Request $data){
		// memasukkan data ke tabel kriteria
		Kriteria::create([
			'id_kriteria_peminatan' => $data->id_kriteria_peminatan,
			'kriteria'              => $data->kriteria
			]);
		
		return redirect('/daftar_kriteria_peminatan/daftar_kriteria/'.$data->id_kriteria_peminatan);
	}

	public function gantiStatus($id){
		$data_daftar_kriteria = KriteriaPeminatan::where('status', 1);
		$data_daftar_kriteria->update([
			'status' => 0
			]);
		$data_daftar_kriteria = KriteriaPeminatan::where('id', $id);
		$data_daftar_kriteria->update([
			'status' => 1
			]);
		return redirect('/daftar_kriteria_peminatan/daftar_kriteria/'.$id);
	}

	public function createKriteria(Request $data){
		$jumlah = $data->jumlah;
		return view('waka_kurikulum.kriteria_peminatan', compact('jumlah'));
	}

	public function showKriteria($id_kriteria_peminatan){
		// mengambil data di tabel kriteria
		$data_kriteria = Kriteria::select(
			'id',
			'kriteria',
			'bobot_prioritas_ipa',
			'bobot_prioritas_ips',
			'bobot_prioritas_bhs',
			'kategori',
			'klasifikasi_nilai',
			DB::raw('DAY(created_at) AS day'),
			DB::raw('MONTH(created_at) AS month'),
			DB::raw('YEAR(created_at) AS year')
			)
		->where('id_kriteria_peminatan', $id_kriteria_peminatan)
		->get();

		// mengambil nilai status daftar kriteria
		$data_status = KriteriaPeminatan::select('status', 'status_bobot')->where('id', $id_kriteria_peminatan)->orderBy('status','desc')->limit(1)->first();
		$status = $data_status->status;
		$status_bobot = $data_status->status_bobot;

		return view('tim_ppdb.daftar_kriteria', compact('data_kriteria', 'status', 'status_bobot', 'id_kriteria_peminatan'));
	}

	public function editKriteria($id){
		$data_kriteria = Kriteria::where('id', $id)->get();
		return view('waka_kurikulum.edit_kriteria', compact('data_kriteria'));
	}

	public function updateKriteria(Request $data, $id_kriteria_peminatan){
		$jumlah = count($data->kriteria);
		for ($i=0; $i < $jumlah; $i++) { 
			$dataEdit = Kriteria::where('id', $data->id[$i]);
			$dataEdit->update([
				'id_kriteria_peminatan' => $id_kriteria_peminatan,
				'kriteria' => $data->kriteria[$i]
				]);
		}
		
		return redirect('/daftar_kriteria_peminatan/daftar_kriteria/'.$id_kriteria_peminatan);
	}

	public function hapusKriteria($id){
		$cek_id = Kriteria::select('id_kriteria_peminatan')->where('id', $id)->first();
		$id_kriteria_peminatan = $cek_id->id_kriteria_peminatan;
		Kriteria::destroy($id);
		
		$update_kriteria_peminatan = KriteriaPeminatan::where('id', $id_kriteria_peminatan);
		$jumlah = KriteriaPeminatan::select('jumlah')->where('id', $id_kriteria_peminatan)->first();
		$update_kriteria_peminatan->update([
			'jumlah'       => ($jumlah->jumlah - 1),
			'status_bobot' => 0
			]);
		return redirect('/daftar_kriteria_peminatan/daftar_kriteria/'.$id_kriteria_peminatan);
	}

	public function onlyTrashedKriteriaPeminatan(){
		$data_kriteria = DB::table('kriteria_peminatan')
		->join('kriteria', 'kriteria.id_kriteria_peminatan', '=', 'kriteria_peminatan.id')
		->select(
			'kriteria.id',
			'kriteria_peminatan.kode_kriteria',
			'kriteria.kriteria'
			)
		->where('kriteria.deleted_at', '!=', NULL)
		->orderBy('kriteria_peminatan.kode_kriteria')
		->get();
		return view('waka_kurikulum.daftar_deleted_kriteria_peminatan', compact('data_kriteria'));
	}

	public function restoreKriteria($id){
		$data_kriteria_peminatan = Kriteria::onlyTrashed()->select('id_kriteria_peminatan')->where('id', $id)->first();
		$jumlah = count(Kriteria::onlyTrashed()->where('id_kriteria_peminatan', $data_kriteria_peminatan->id_kriteria_peminatan)->get());
		if ($jumlah == 1) {
			KriteriaPeminatan::onlyTrashed()->where('id', $data_kriteria_peminatan->id_kriteria_peminatan)->restore();
		}
		Kriteria::onlyTrashed()->where('id', $id)->restore();
		return redirect('/deleted_kriteria');
	}

	public function deleteDaftarKriteria($id){
		$daftar_kriteria = Kriteria::where('id_kriteria_peminatan', $id);
		$daftar_kriteria->delete();
		$kriteria_peminatan = KriteriaPeminatan::where('id', $id);
		$kriteria_peminatan->update([
			'status' => 0
			]);
		KriteriaPeminatan::destroy($id);
		return redirect('/daftar_kriteria_peminatan');
	}

	public function tentukanNilaiPerbandinganBerpasanganIPA($id){
		$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
		$id_pesan = 0;
		return view('tim_ppdb.nilai_perbandingan_berpasangan_ipa', compact('data_kriteria', 'id', 'id_pesan'));
	}

	public function tentukanNilaiPerbandinganBerpasanganIPS($id){
		$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
		$id_pesan = 0;
		return view('tim_ppdb.nilai_perbandingan_berpasangan_ips', compact('data_kriteria', 'id', 'id_pesan'));
	}

	public function tentukanNilaiPerbandinganBerpasanganBHS($id){
		$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
		$id_pesan = 0;
		return view('tim_ppdb.nilai_perbandingan_berpasangan_bhs', compact('data_kriteria', 'id', 'id_pesan'));
	}

	public function instruksiPenentuanBobot($id){
		return view('tim_ppdb.instruksi', compact('id'));
	}

	// ===============================

	public function hitungCI_CR_IPA(Request $data, $id){
		$jumlah_kriteria = count(Kriteria::where('id_kriteria_peminatan', $id)->get());
		$id_pesan = 0;

		// NORMALISASI MATRIKS PERBANDINGAN BERPASANGAN

		// Menghitung jumlah nilai tiap kolom
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$jumlah_nilai_kolom[$i] = 0;
		}

        // *nilai_pb = perbandingan berpasangan 
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$jumlah_nilai_kolom[$i] += $data->nilai_pb[$j][$i];
			}
		}

		// *x = Normalisasi matriks baris ke-m, kolom ke-n
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$x[$i][$j] = $data->nilai_pb[$i][$j]/$jumlah_nilai_kolom[$j];
			}
		}

		// Nilai sintesis kriteria ke-n
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_sintesis_kriteria[$i] = 0;
		}

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$nilai_sintesis_kriteria[$i] += $x[$i][$j];
			}
		}

		// Hasil perkalian bobot kriteria 
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$jumlah_perkalian_baris[$i] = 1;
		}

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$jumlah_perkalian_baris[$i] *= $data->nilai_pb[$i][$j];
			}
		}

		// Nilai eigen kriteria
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_eigen_kriteria[$i] = pow($jumlah_perkalian_baris[$i], (1 / $jumlah_kriteria));
		}

		// Total nilai eigen
		$total_nilai_eigen = 0;

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$total_nilai_eigen += $nilai_eigen_kriteria[$i];
		}
		
		// *BP = Nilai bobot prioritas
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$BP[$i] = round(($nilai_eigen_kriteria[$i] / $total_nilai_eigen), 4);		
		}

		// Nilai Kepentingan tiap kriteria
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_kepentingan_kriteria[$i] = $nilai_sintesis_kriteria[$i] / $BP[$i];
		}

		$total_nilai_kepentingan = 0;

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$total_nilai_kepentingan += $nilai_kepentingan_kriteria[$i];
		}

		// Nilai eigen max.
		$nilai_eigen_max = $total_nilai_kepentingan / $jumlah_kriteria;

		// Hitung CI
		$CI = ($nilai_eigen_max - $jumlah_kriteria) / ($jumlah_kriteria - 1);

		if ($CI == 0) {
			// simpan bobot prioritas
			for ($i=0; $i < $jumlah_kriteria; $i++) { 
				$id_bobot_prioritas = Kriteria::where('id', $data->id_kriteria[$i]);
				$id_bobot_prioritas->update([
					'bobot_prioritas_ipa' => $BP[$i]
					]);
			}
			return redirect('/daftar_kriteria/nilai_perbandingan_berpasangan_ips/'.$id);
		} else {
			// Menentukan RI
			if ($jumlah_kriteria == 1) {
				$RI = 0;
			} elseif ($jumlah_kriteria == 2) {
				$RI = 0;
			} elseif ($jumlah_kriteria == 3) {
				$RI = 0.58;
			} elseif ($jumlah_kriteria == 4) {
				$RI = 0.9;
			} elseif ($jumlah_kriteria == 5) {
				$RI = 1.12;
			} elseif ($jumlah_kriteria == 6) {
				$RI = 1.24;
			} elseif ($jumlah_kriteria == 7) {
				$RI = 1.32;
			} elseif ($jumlah_kriteria == 8) {
				$RI = 1.41;
			} elseif ($jumlah_kriteria == 9) {
				$RI = 1.45;
			} elseif ($jumlah_kriteria == 10) {
				$RI = 1.49;
			} elseif ($jumlah_kriteria == 11) {
				$RI = 1.51;
			} elseif ($jumlah_kriteria == 12) {
				$RI = 1.48;
			} elseif ($jumlah_kriteria == 13) {
				$RI = 1.56;
			} elseif ($jumlah_kriteria == 14) {
				$RI = 1.57;
			} elseif ($jumlah_kriteria == 15) {
				$RI = 1.59;
			}
		    // Hitung CR
			if ($RI != 0) {
				$CR = $CI / $RI;

				if ($CR <= 0.1) {
					// simpan bobot prioritas
					for ($i=0; $i < $jumlah_kriteria; $i++) { 
						$id_bobot_prioritas = Kriteria::where('id', $data->id_kriteria[$i]);
						$id_bobot_prioritas->update([
							'bobot_prioritas_ipa' => $BP[$i]
							]);
					}
					return redirect('/daftar_kriteria/nilai_perbandingan_berpasangan_ips/'.$id);
				} else {
					$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
					$id_pesan = 1;
					return view('tim_ppdb.nilai_perbandingan_berpasangan_ipa', compact('data_kriteria', 'id', 'id_pesan'));
				}	
			} else {
				$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
				$id_pesan = 1;
				return view('tim_ppdb.nilai_perbandingan_berpasangan_ipa', compact('data_kriteria', 'id', 'id_pesan'));
			}
			
		}

	}

	public function hitungCI_CR_IPS(Request $data, $id){
		$jumlah_kriteria = count(Kriteria::where('id_kriteria_peminatan', $id)->get());
		$id_pesan = 0;

		// NORMALISASI MATRIKS PERBANDINGAN BERPASANGAN

		// Menghitung jumlah nilai tiap kolom
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$jumlah_nilai_kolom[$i] = 0;
		}

        // *nilai_pb = perbandingan berpasangan 
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$jumlah_nilai_kolom[$i] += $data->nilai_pb[$j][$i];
			}
		}

		// *x = Normalisasi matriks baris ke-m, kolom ke-n
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$x[$i][$j] = $data->nilai_pb[$i][$j]/$jumlah_nilai_kolom[$j];
			}
		}

		// Nilai sintesis kriteria ke-n
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_sintesis_kriteria[$i] = 0;
		}

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$nilai_sintesis_kriteria[$i] += $x[$i][$j];
			}
		}

		// Hasil perkalian bobot kriteria 
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$jumlah_perkalian_baris[$i] = 1;
		}

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$jumlah_perkalian_baris[$i] *= $data->nilai_pb[$i][$j];
			}
		}

		// Nilai eigen kriteria
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_eigen_kriteria[$i] = pow($jumlah_perkalian_baris[$i], (1 / $jumlah_kriteria));
		}

		// Total nilai eigen
		$total_nilai_eigen = 0;

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$total_nilai_eigen += $nilai_eigen_kriteria[$i];
		}
		
		// *BP = Nilai bobot prioritas
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$BP[$i] = round(($nilai_eigen_kriteria[$i] / $total_nilai_eigen), 4);		
		}

		// Nilai Kepentingan tiap kriteria
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_kepentingan_kriteria[$i] = $nilai_sintesis_kriteria[$i] / $BP[$i];
		}

		$total_nilai_kepentingan = 0;

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$total_nilai_kepentingan += $nilai_kepentingan_kriteria[$i];
		}

		// Nilai eigen max.
		$nilai_eigen_max = $total_nilai_kepentingan / $jumlah_kriteria;

		// Hitung CI
		$CI = ($nilai_eigen_max - $jumlah_kriteria) / ($jumlah_kriteria - 1);

		if ($CI == 0) {
			// simpan bobot prioritas
			for ($i=0; $i < $jumlah_kriteria; $i++) { 
				$id_bobot_prioritas = Kriteria::where('id', $data->id_kriteria[$i]);
				$id_bobot_prioritas->update([
					'bobot_prioritas_ips' => $BP[$i]
					]);
			}
			return redirect('/daftar_kriteria/nilai_perbandingan_berpasangan_bhs/'.$id);
		} else {
			// Menentukan RI
			if ($jumlah_kriteria == 1) {
				$RI = 0;
			} elseif ($jumlah_kriteria == 2) {
				$RI = 0;
			} elseif ($jumlah_kriteria == 3) {
				$RI = 0.58;
			} elseif ($jumlah_kriteria == 4) {
				$RI = 0.9;
			} elseif ($jumlah_kriteria == 5) {
				$RI = 1.12;
			} elseif ($jumlah_kriteria == 6) {
				$RI = 1.24;
			} elseif ($jumlah_kriteria == 7) {
				$RI = 1.32;
			} elseif ($jumlah_kriteria == 8) {
				$RI = 1.41;
			} elseif ($jumlah_kriteria == 9) {
				$RI = 1.45;
			} elseif ($jumlah_kriteria == 10) {
				$RI = 1.49;
			} elseif ($jumlah_kriteria == 11) {
				$RI = 1.51;
			} elseif ($jumlah_kriteria == 12) {
				$RI = 1.48;
			} elseif ($jumlah_kriteria == 13) {
				$RI = 1.56;
			} elseif ($jumlah_kriteria == 14) {
				$RI = 1.57;
			} elseif ($jumlah_kriteria == 15) {
				$RI = 1.59;
			}
		    // Hitung CR
			if ($RI != 0) {
				$CR = $CI / $RI;
				if ($CR <= 0.1) {
					// simpan bobot prioritas
					for ($i=0; $i < $jumlah_kriteria; $i++) { 
						$id_bobot_prioritas = Kriteria::where('id', $data->id_kriteria[$i]);
						$id_bobot_prioritas->update([
							'bobot_prioritas_ips' => $BP[$i]
							]);
					}
					return redirect('/daftar_kriteria/nilai_perbandingan_berpasangan_bhs/'.$id);
				} else {
					$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
					$id_pesan = 1;
					return view('tim_ppdb.nilai_perbandingan_berpasangan_ips', compact('data_kriteria', 'id', 'id_pesan'));
				}	
			} else {
				$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
				$id_pesan = 1;
				return view('tim_ppdb.nilai_perbandingan_berpasangan_ips', compact('data_kriteria', 'id', 'id_pesan'));
			}
			
		}

	}

	public function hitungCI_CR_BHS(Request $data, $id){
		$jumlah_kriteria = count(Kriteria::where('id_kriteria_peminatan', $id)->get());
		$id_pesan = 0;

		// NORMALISASI MATRIKS PERBANDINGAN BERPASANGAN

		// Menghitung jumlah nilai tiap kolom
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$jumlah_nilai_kolom[$i] = 0;
		}

        // *nilai_pb = perbandingan berpasangan 
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$jumlah_nilai_kolom[$i] += $data->nilai_pb[$j][$i];
			}
		}

		// *x = Normalisasi matriks baris ke-m, kolom ke-n
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$x[$i][$j] = $data->nilai_pb[$i][$j]/$jumlah_nilai_kolom[$j];
			}
		}

		// Nilai sintesis kriteria ke-n
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_sintesis_kriteria[$i] = 0;
		}

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$nilai_sintesis_kriteria[$i] += $x[$i][$j];
			}
		}

		// Hasil perkalian bobot kriteria 
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$jumlah_perkalian_baris[$i] = 1;
		}

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			for ($j=0; $j < $jumlah_kriteria; $j++) { 
				$jumlah_perkalian_baris[$i] *= $data->nilai_pb[$i][$j];
			}
		}

		// Nilai eigen kriteria
		for ($i=0; $i < $jumlah_kriteria; $i++) {
			$nilai_eigen_kriteria[$i] = pow($jumlah_perkalian_baris[$i], (1 / $jumlah_kriteria));
		}

		// Total nilai eigen
		$total_nilai_eigen = 0;

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$total_nilai_eigen += $nilai_eigen_kriteria[$i];
		}
		
		// *BP = Nilai bobot prioritas
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$BP[$i] = round(($nilai_eigen_kriteria[$i] / $total_nilai_eigen), 4);		
		}

		// Nilai Kepentingan tiap kriteria
		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$nilai_kepentingan_kriteria[$i] = $nilai_sintesis_kriteria[$i] / $BP[$i];
		}

		$total_nilai_kepentingan = 0;

		for ($i=0; $i < $jumlah_kriteria; $i++) { 
			$total_nilai_kepentingan += $nilai_kepentingan_kriteria[$i];
		}

		// Nilai eigen max
		$nilai_eigen_max = $total_nilai_kepentingan / $jumlah_kriteria;

		// Hitung CI
		$CI = ($nilai_eigen_max - $jumlah_kriteria) / ($jumlah_kriteria - 1);

		if ($CI == 0) {
			// simpan bobot prioritas
			for ($i=0; $i < $jumlah_kriteria; $i++) { 
				$id_bobot_prioritas = Kriteria::where('id', $data->id_kriteria[$i]);
				$id_bobot_prioritas->update([
					'bobot_prioritas_bhs' => $BP[$i]
					]);
			}

			// mengubah status bobot
			$id_status_bobot = KriteriaPeminatan::where('id', $id);
			$id_bobot_prioritas->update([
				'status_bobot' => 1
				]);
			return redirect('/daftar_kriteria_peminatan');
		} else {
			// Menentukan RI
			if ($jumlah_kriteria == 1) {
				$RI = 0;
			} elseif ($jumlah_kriteria == 2) {
				$RI = 0;
			} elseif ($jumlah_kriteria == 3) {
				$RI = 0.58;
			} elseif ($jumlah_kriteria == 4) {
				$RI = 0.9;
			} elseif ($jumlah_kriteria == 5) {
				$RI = 1.12;
			} elseif ($jumlah_kriteria == 6) {
				$RI = 1.24;
			} elseif ($jumlah_kriteria == 7) {
				$RI = 1.32;
			} elseif ($jumlah_kriteria == 8) {
				$RI = 1.41;
			} elseif ($jumlah_kriteria == 9) {
				$RI = 1.45;
			} elseif ($jumlah_kriteria == 10) {
				$RI = 1.49;
			} elseif ($jumlah_kriteria == 11) {
				$RI = 1.51;
			} elseif ($jumlah_kriteria == 12) {
				$RI = 1.48;
			} elseif ($jumlah_kriteria == 13) {
				$RI = 1.56;
			} elseif ($jumlah_kriteria == 14) {
				$RI = 1.57;
			} elseif ($jumlah_kriteria == 15) {
				$RI = 1.59;
			}
		    // Hitung CR
			if ($RI != 0) {
				$CR = $CI / $RI;
				if ($CR <= 0.1) {
					// simpan bobot prioritas
					for ($i=0; $i < $jumlah_kriteria; $i++) { 
						$id_bobot_prioritas = Kriteria::where('id', $data->id_kriteria[$i]);
						$id_bobot_prioritas->update([
							'bobot_prioritas_bhs' => $BP[$i]
							]);
					}

					// mengubah status bobot
					$id_status_bobot = KriteriaPeminatan::where('id', $id);
					$id_status_bobot->update([
						'status_bobot' => 1
						]);

					return redirect('/daftar_kriteria_peminatan');
				} else {
					$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
					$id_pesan = 1;
					return view('tim_ppdb.nilai_perbandingan_berpasangan_bhs', compact('data_kriteria', 'id', 'id_pesan'));
				}	
			} else {
				$data_kriteria = Kriteria::where('id_kriteria_peminatan', $id)->get();
				$id_pesan = 1;
				return view('tim_ppdb.nilai_perbandingan_berpasangan_bhs', compact('data_kriteria', 'id', 'id_pesan'));
			}
			
		}

	}


}
