<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rombel;

class RombelController extends Controller
{

	public function showTahunAjaran(){
		$data_rombel = Rombel::select('tahun_ajar', DB::raw('count(id) as jumlah_rombel'))->groupBy('tahun_ajar')->orderBy('tahun_ajar', 'desc')->get();
		return view('waka_kurikulum.tahun_ajaran', compact('data_rombel'));
	}

	public function showRombelTahunAjaran($tahun_ajaran){
		$data_rombel = Rombel::select('id', 'peminatan', 'nama_rombel', 'wali_kelas', 'jumlah_siswa', 'kuota_kelas')->where('tahun_ajar', $tahun_ajaran)->orderBy('peminatan')->get();
		return view('waka_kurikulum.daftar_rombel', compact('data_rombel', 'tahun_ajaran'));
	}

	public function tambahRombel(Request $data){
		$jumlah = $data->jumlah;
		return view('waka_kurikulum.tambah_rombel', compact('jumlah'));
	}

	public function tambahRombelIPS(Request $data){
		$jumlah = $data->jumlah;
		return view('waka_kurikulum.tambah_rombel_ips', compact('jumlah'));
	}

	public function tambahRombelBHS(Request $data){
		$jumlah = $data->jumlah;
		return view('waka_kurikulum.tambah_rombel_bhs', compact('jumlah'));
	}

	public function createRombel(Request $data){
		$jumlah = $data->jumlah;

		if (($data->peminatan) == "ipa") {
			return view('waka_kurikulum.tambah_rombel_ipa', compact('jumlah'));
		} elseif (($data->peminatan) == "ips") {
			return view('waka_kurikulum.tambah_rombel_ips', compact('jumlah'));
		} else {
			return view('waka_kurikulum.tambah_rombel_bahasa', compact('jumlah'));
		}
	}

	public function storeRombel(Request $data){
		$jumlah_baris = count($data->nama_rombel);

		for ($i=0; $i < $jumlah_baris; $i++) {
			Rombel::create([
				'nama_rombel' => $data->nama_rombel[$i],
				'wali_kelas'  => $data->wali_kelas[$i],
				'kuota_kelas' => $data->kuota_kelas[$i],
				'peminatan'   => $data->peminatan[$i],
				'tahun_ajar'  => $data->tahun_ajaran[$i]
				]);
		}

		return redirect('/tahun_ajaran');

	}

	public function showRombelIPA(){
		$data_rombel = Rombel::where('peminatan', 'ipa')->orderBy('tahun_ajar', 'desc')->get();
		return view('waka_kurikulum.daftar_rombel_ipa', compact('data_rombel'));
	}

	public function showRombelIPS(){
		$data_rombel = Rombel::where('peminatan', 'ips')->orderBy('tahun_ajar', 'desc')->get();
		return view('waka_kurikulum.daftar_rombel_ips', compact('data_rombel'));
	}

	public function showRombelBahasa(){
		$data_rombel = Rombel::where('peminatan', 'bahasa')->orderBy('tahun_ajar', 'desc')->get();
		return view('waka_kurikulum.daftar_rombel_bahasa', compact('data_rombel'));
	}

	public function editRombel($id){
		$data_rombel = Rombel::where('id', $id)->get();
		return view('waka_kurikulum.edit_rombel', compact('data_rombel'));
	}

	public function updateRombel(Request $data){
		$dataEdit = Rombel::where('id', $data->id);
		$dataEdit->update([
			'nama_rombel' => $data->nama_rombel,
			'wali_kelas'  => $data->wali_kelas,
			'kuota_kelas' => $data->kuota_kelas,
			'tahun_ajar'  => $data->tahun_ajaran
			]);

		return redirect('/tahun_ajaran/daftar_rombel/'.$data->tahun_ajaran);
	}

	public function softDeletesRombel($id){
		$data_rombel = Rombel::select('tahun_ajar')->where('id', $id)->first();

		$data = Rombel::find($id);
		Rombel::destroy($id);

		return redirect('/tahun_ajaran/daftar_rombel/'.$data_rombel->tahun_ajar);
	}

	public function onlyTrashedRombel(){
		$data_rombel = Rombel::select('id', 'peminatan', 'nama_rombel', 'wali_kelas', 'jumlah_siswa', 'kuota_kelas', 'tahun_ajar')->orderBy('peminatan')->onlyTrashed()->get();
		return view('waka_kurikulum.daftar_rombel_deleted', compact('data_rombel'));
	}

	// public function onlyTrashedRombelIPS(){
	// 	$data_rombel = Rombel::onlyTrashed()->where('peminatan', 'ips')->get();
	// 	return view('waka_kurikulum.daftar_deleted_rombel_ips', compact('data_rombel'));
	// }

	// public function onlyTrashedRombelBahasa(){
	// 	$data_rombel = Rombel::onlyTrashed()->where('peminatan', 'bahasa')->get();
	// 	return view('waka_kurikulum.daftar_deleted_rombel_bahasa', compact('data_rombel'));
	// }

	public function restoreRombel($id){
		$data_rombel = Rombel::onlyTrashed()->select('peminatan')->where('id', $id)->first();
		Rombel::onlyTrashed()->where('id', $id)->restore();
		
		return redirect('/daftar_rombel_deleted');
	}

}
