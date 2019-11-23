<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SoalPsikotest;
use App\Psikotest;

class PsikotestController extends Controller
{
	public function tampilkanSoalPsikotest(){
        $psikotest = Psikotest::where('status', 1)->first();
        $data_soal = SoalPsikotest::where('id_psikotest', $psikotest->id)->get();
        return view('siswa.psikotest', compact('data_soal'));
    }

    public function createSoal(){
      return view('tim_ppdb.buat_soal');
  }

  public function buatSoalPsikotest(Request $data){
      $jumlah = $data->jumlah;
      return view('tim_ppdb.buat_soal_psikotest', compact('jumlah'));
  }

  public function tambahSoalPsikotest(Request $data, $kode_soal){
      $jumlah = $data->jumlah;
      $psikotest = Psikotest::where('psikotest_code', $kode_soal)->first();
      $id_psikotest = $psikotest->id;
      return view('tim_ppdb.buat_soal_psikotest_with_code', compact('jumlah','kode_soal', 'id_psikotest'));
  }

	// BELUM SELESAI
  public function simpanSoalPsikotest(Request $data){

      $id_psikotest = Psikotest::select('id')->orderBy('id', 'DESC')->limit(1)->get();
      $jumlah_baris = count($id_psikotest);
      $jumlah_soal = count($data->soal);

      if ($jumlah_baris == 0) {
         $psikotest_code = 'code_01';
     } else { 
         foreach ($id_psikotest as $data_psikotest) {
            $psikotest_code = 'code_0'.($data_psikotest->id);
        }
    }

    Psikotest::create([
     'psikotest_code' => $psikotest_code
     ]);

    $recent_id = Psikotest::select('id')->orderBy('id', 'DESC')->limit(1)->get();

    foreach ($recent_id as $data_psikotest) {
     $id_psikotest = $data_psikotest->id;
 }

 for ($i=0; $i < $jumlah_soal; $i++) { 

     $file = $data->file('gambar')[$i];
     if ($file != "") {
        $ext = $file->getClientOriginalExtension();
        $nama_foto = rand(100000,1001238912).".".$ext;
        $path_gambar = 'uploads/gambar'.$nama_foto;
                /*
                - CARI TAU CARA MEMASUKKAN FOTO KE DALAM FOLDER
                - CARI TAU KONFIGURASI UKURAN FILE YANG BISA DI POST
                */
                $file->move('uploads/gambar',$nama_foto);
            } else {
            	$path_gambar = NULL;
            }

            SoalPsikotest::create([
            	'soal' => $data->soal[$i],
            	'gambar' => $path_gambar,
            	'a' => $data->a[$i],
            	'b' => $data->b[$i],
            	'c' => $data->c[$i],
            	'd' => $data->d[$i],
            	'e' => $data->e[$i],
            	'jawaban' => $data->jawaban[$i],
            	'id_psikotest' => $id_psikotest
            	]);
        }

        return redirect('/daftar_psikotest');

    }

    public function simpanSoalPsikotestWithCode(Request $data){

		$jumlah_soal = count($data->soal);
        $recent_id = Psikotest::select('id')->where('psikotest_code', $data->kode)->get();

    	foreach ($recent_id as $data_psikotest) {
    		$id_psikotest = $data_psikotest->id;
    	}

    	for ($i=0; $i < $jumlah_soal; $i++) { 

    		$file = $data->file('gambar')[$i];
    		if ($file != "") {
    			$ext = $file->getClientOriginalExtension();
    			$nama_foto = rand(100000,1001238912).".".$ext;
    			$path_gambar = 'uploads/gambar'.$nama_foto;
                /*
                - CARI TAU CARA MEMASUKKAN FOTO KE DALAM FOLDER
                - CARI TAU KONFIGURASI UKURAN FILE YANG BISA DI POST
                */
                $file->move('uploads/gambar',$nama_foto);
            } else {
            	$path_gambar = NULL;
            }

            SoalPsikotest::create([
            	'soal' => $data->soal[$i],
            	'gambar' => $path_gambar,
            	'a' => $data->a[$i],
            	'b' => $data->b[$i],
            	'c' => $data->c[$i],
            	'd' => $data->d[$i],
            	'e' => $data->e[$i],
            	'jawaban' => $data->jawaban[$i],
            	'id_psikotest' => $id_psikotest
            	]);
        }

        return redirect('/daftar_psikotest');

    }

    // belum selesai
    public function storeJawabanSoal(Request $data){
        return dd($data);
    }

    public function showDaftarPsikotest(){
    	$data_psikotest = Psikotest::select(
            'id',
            'psikotest_code',
            'status',
            DB::raw('DAY(created_at) AS day'),
            DB::raw('MONTH(created_at) AS month'),
            DB::raw('YEAR(created_at) AS year')
            )
        ->get();
        return view('tim_ppdb.daftar_psikotest', compact('data_psikotest'));
    }

    public function aktifkanPsikotest($id){
        $psikotest = Psikotest::where('status', 1);
        $psikotest->update([
            'status' => 0
            ]);
        $psikotest = Psikotest::where('id', $id);
        $psikotest->update([
            'status' => 1
            ]);
        return redirect('/daftar_psikotest');
    }

    public function showSoalPsikotest($id_psikotest){
    	$data_soal = SoalPsikotest::where('id_psikotest', $id_psikotest)->get();
    	$psikotest = Psikotest::select('psikotest_code')->where('id', $id_psikotest)->first();
        $kode_soal = $psikotest->psikotest_code;
    	return view('tim_ppdb.soal_psikotest', compact('data_soal','kode_soal'));
    }

    public function showInstruksiPengerjaan(){
        return view('siswa.instruksi_pengerjaan_psikotest');
    }

    public function addSoalPsikotest($kode_soal){
    	return view('tim_ppdb.jumlah_soal', compact('kode_soal'));
    }

    public function editSoalPsikotest($id){
    	$data_soal = SoalPsikotest::where('id', $id)->get();
    	return view('tim_ppdb.edit_soal_psikotest', compact('data_soal'));
    }

    public function updateSoalPsikotest(Request $data){
    	$dataEdit = SoalPsikotest::where('id', $data->id);
    	$dataEdit->update([
    		'soal' => $data->soal,
    		'gambar' => $data->gambar,
    		'a' => $data->a,
    		'b' => $data->b,
    		'c' => $data->c,
    		'd' => $data->d,
    		'e' => $data->e,
    		'jawaban' => $data->jawaban
    		]);
    	return redirect('/lihat_soal_psikotest/'.$data->id_psikotest);
    }

    public function softDeletesPsikotest($id){
    	Psikotest::destroy($id);
    	return redirect('/daftar_psikotest');
    }

    public function softDeletesSoalPsikotest($id_soal){
    	$data_soal = SoalPsikotest::select('id_psikotest')->where('id', $id_soal)->get();
    	foreach ($data_soal as $data) {
    		$id_psikotest = $data->id_psikotest;
    	}
    	SoalPsikotest::destroy($id_soal);
    	return redirect('/lihat_soal_psikotest/'.$id_psikotest);
    }

    public function onlyTrashedSoalPsikotest($id_psikotest){
    	$data_soal = DB::table('psikotest')
    	->join('soal_psikotest', 'psikotest.id', '=', 'soal_psikotest.id_psikotest')
    	->select(
    		'soal_psikotest.id',
    		'soal_psikotest.soal', 
    		'soal_psikotest.gambar',
    		'soal_psikotest.a', 
    		'soal_psikotest.b', 
    		'soal_psikotest.c', 
    		'soal_psikotest.d', 
    		'soal_psikotest.e', 
    		'soal_psikotest.jawaban', 
    		DB::raw('DAY(soal_psikotest.created_at) AS day'), 
    		DB::raw('MONTH(soal_psikotest.created_at) AS month'), 
    		DB::raw('YEAR(soal_psikotest.created_at) AS year'), 
    		'psikotest.psikotest_code'
    		)
    	->where([
    		['soal_psikotest.deleted_at', '!=', 'NULL'],
    		['soal_psikotest.id_psikotest', '=', $id_psikotest],
    		])
    	->orderBy('soal_psikotest.created_at', 'DESC')
    	->get();

    	return view('tim_ppdb.daftar_deleted_soal_psikotest', compact('data_soal'));
    }

    public function onlyTrashedPsikotest(){
    	$data_psikotest = Psikotest::withTrashed()->get();
    	return view('tim_ppdb.daftar_deleted_psikotest', compact('data_psikotest'));
    }

    public function restoreSoalPsikotest($id_soal){
    	$data_soal = SoalPsikotest::onlyTrashed()->select('id_psikotest')->where('id', $id_soal)->limit(1)->get();

    	foreach ($data_soal as $data) {
    		$id_psikotest = $data->id_psikotest;
    	}

    	SoalPsikotest::onlyTrashed()->where('id', $id_soal)->restore();

    	return redirect('/deleted_soal_psikotest/'.$id_psikotest);
    }

    public function restorePsikotest($id_psikotest){
    	Psikotest::onlyTrashed()->where('id', $id_psikotest)->restore();
    	return redirect('/deleted_psikotest');
    }

}
