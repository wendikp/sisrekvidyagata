<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kriteria;
use App\KriteriaPeminatan;
use App\AngketPeminatanSiswa;
use App\User;

class KriteriaTimPPDBController extends Controller
{

	public function showKriteria(){
		$kriteria_peminatan = KriteriaPeminatan::select('id', 'kode_kriteria')->where('status', '1')->first();
		$kode_kriteria = $kriteria_peminatan->kode_kriteria;
		$data_kriteria = Kriteria::select(
			'id',
			'kriteria',
			'kategori',
			'klasifikasi_nilai',
			DB::raw('DAY(created_at) AS day'),
			DB::raw('MONTH(created_at) AS month'),
			DB::raw('YEAR(created_at) AS year')
			)
		->where('id_kriteria_peminatan', $kriteria_peminatan->id)
		->get();
		return view('tim_ppdb.daftar_kriteria', compact('data_kriteria', 'kode_kriteria'));
	}

	public function angkatanSiswa(){
		// $kriteria = KriteriaPeminatan::select('jumlah')->where('status', 1)->first();
		// $jumlah_kriteria = $kriteria->jumlah;

		$data_siswa = User::select(DB::raw('COUNT(id) AS total_siswa'))->where('role', 'Siswa')->groupBy('angkatan')->orderBy('angkatan', 'desc')->get();
		$i = 0;
		foreach ($data_siswa as $data) {
			$total_siswa[$i] = $data->total_siswa;
			$i++;
		}

		$data_angkatan = User::leftJoin('angket_peminatan', 'users.id', '=', 'angket_peminatan.id_user')
		->leftJoin('rekomendasi_peminatan', 'users.id', '=', 'rekomendasi_peminatan.id_user')
		->select(
			'users.angkatan',
			DB::raw('COUNT(users.id) AS total_siswa'),
			DB::raw('COUNT(angket_peminatan.id_user) AS jml_pengisi_angket'),
			DB::raw('COUNT(rekomendasi_peminatan.id_user) AS rekomendasi')
			)
		->where('role', 'Siswa')
		->groupBy('users.angkatan')
		->orderBy('users.angkatan', 'desc')
		->get();

		$data_record_kriteria = DB::table('record_kriteria_peminatan')
		->join('kriteria_peminatan', 'kriteria_peminatan.id', '=', 'record_kriteria_peminatan.id_kriteria_peminatan')
		->select('kriteria_peminatan.kode_kriteria', 'record_kriteria_peminatan.angkatan')
		->get();

		$i=0;
		foreach ($data_record_kriteria as $data) {
			$kode_kriteria[$i] = $data->kode_kriteria;
			$angkatan[$i] = $data->angkatan;
			$i++;
		}

        return view('tim_ppdb.angkatan_siswa', compact('data_angkatan', 'total_siswa', 'kode_kriteria', 'angkatan', 'data_record_kriteria'));
	}

	// ini v1
	

	// public function showAngketPeminatanSiswa(){
	// 	$data_angket = DB::table('angket_peminatan'){
	// 	}
	// }

	public function editAngketPeminatanSiswa($id){
		$data_angket = DB::table('angket_peminatan')
		->join('users', 'users.id', '=', 'angket_peminatan.id_user')
		->join('kriteria', 'kriteria.id', '=', 'angket_peminatan.id_kriteria')
		->select('users.no_induk', 'users.name', 'kriteria.kriteria', 'angket_peminatan.nilai', 'angket_peminatan.id')
		->where('angket_peminatan.id_user', $id)
		->get();

		return view('tim_ppdb.edit_angket_peminatan_siswa', compact('data_angket'));
	}

	public function updateAngketPeminatanSiswa(Request $data){
		$jumlah_baris = count($data->id);

		for ($i=0; $i < $jumlah_baris; $i++) { 
			$baris_nilai = AngketPeminatanSiswa::where('id', $data->id[$i]);
			$baris_nilai->update([
				'nilai' => $data->nilai[$i]
				]);
		}

		return redirect('/angket_peminatan_siswa');
	}

	public function softDeletesAngketPeminatanSiswa($id){
		$id_angket = AngketPeminatanSiswa::select('id')->where('id_user', $id)->get();

		foreach ($id_angket as $id) {
			AngketPeminatanSiswa::destroy($id->id);
		}

		return redirect('/angket_peminatan_siswa');

	}

	public function onlyTrashedKriteriaPeminatan(){
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
		->onlyTrashed()
		->get();

		return view('tim_ppdb.daftar_deleted_angket_peminatan_siswa', compact('data_kriteria_peminatan'));
	}

	public function restoreKriteriaPeminatan($id){
		KriteriaPeminatan::onlyTrashed()->where('id', $id)->restore();
		return redirect('/daftar_kriteria_peminatan_deleted');
	}
}
