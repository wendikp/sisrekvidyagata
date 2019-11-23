<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{

    public function createPengumuman(){
        return view('tim_ppdb.buat_pengumuman');
    }

    public function detailPengumuman($id){
        $kriteria_peminatan = DB::table('record_kriteria_peminatan')->select('id_kriteria_peminatan')->where('angkatan', Auth::user()->angkatan)->first();

        $pengumuman = Pengumuman::select(
            'id',
            'judul',
            DB::raw('DAY(created_at) AS day'),
            DB::raw('MONTH(created_at) AS month'),
            DB::raw('YEAR(created_at) AS year')
            )
        ->orderBy('created_at', 'desc')
        ->get();

        $pengumumanid = Pengumuman::select(
            'judul',
            'isi',
            DB::raw('DAY(created_at) AS day'),
            DB::raw('MONTH(created_at) AS month'),
            DB::raw('YEAR(created_at) AS year')
            )
        ->where('id', $id)
        ->get();
    	return view('siswa.pengumuman', compact('pengumuman', 'pengumumanid', 'kriteria_peminatan', 'id'));
    }

    public function storePengumuman(Request $data){
        Pengumuman::create([
    		'judul' => $data->judul,
    		'id_user' => $data->id,
    		'isi' => $data->isi
    		]);

    	return redirect('/daftar_pengumuman');
    }

    public function daftarPengumuman(){
    	$data_pengumuman = DB::table('pengumuman')
		    ->join('users', 'users.id', '=', 'pengumuman.id_user')
		    ->select(
                'users.name', 
                'pengumuman.*',
                DB::raw('DAY(pengumuman.created_at) AS day'),
                DB::raw('MONTH(pengumuman.created_at) AS month'),
                DB::raw('YEAR(pengumuman.created_at) AS year')
                )
            ->where('pengumuman.deleted_at', '=', NULL)
            ->orderBy('pengumuman.created_at', 'desc')
		    ->get();

    	return view('tim_ppdb.daftar_pengumuman', compact('data_pengumuman'));
    }

    //belum selesai
    public function editPengumuman($id){
    	$data_pengumuman = DB::table('pengumuman')
		    ->join('users', 'users.id', '=', 'pengumuman.id_user')
		    ->select('users.name', 'pengumuman.*')
		    ->where('pengumuman.id', $id)
		    ->get();

    	return view('tim_ppdb.edit_pengumuman', compact('data_pengumuman'));
    }

    // belum diuji
    public function updatePengumuman(Request $data){
    	$dataEdit = Pengumuman::where('id', $data->id);
    	$dataEdit->update([
    		'isi' => $data->isi,
    		'judul' => $data->judul
    		]);

    	return redirect('/daftar_pengumuman');
    }

    // belum diuji
    public function softDeletesPengumuman($id){
    	Pengumuman::destroy($id);
    	return redirect('/daftar_pengumuman');
    }

    public function tampilkanPengumuman(){
    	$data_pengumuman = DB::table('pengumuman')
		    ->join('users', 'users.id', '=', 'pengumuman.id_user')
		    ->select('users.name', 'pengumuman.*')
		    ->where('id', $id)
		    ->get();

		return view('tim_ppdb.pengumuman', compact('data_pengumuman'));
    }

    public function onlyTrashedPengumuman(){
        $data_pengumuman = DB::table('pengumuman')
            ->join('users', 'users.id', '=', 'pengumuman.id_user')
            ->select('users.name', 'pengumuman.*')
            ->where('pengumuman.deleted_at', '!=', NULL)
            ->get();

        return view('tim_ppdb.daftar_deleted_pengumuman', compact('data_pengumuman'));
    }

    public function restorePengumuman($id_pengumuman){
        Pengumuman::onlyTrashed()->where('id', $id_pengumuman)->restore();
        return redirect('/deleted_pengumuman');
    }
}
