<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pengumuman;

class PengumumanSiswaController extends Controller
{
    public function daftarPengumuman(){
    	$data_pengumuman = Pengumuman::all();
    	return view('siswa.daftar_pengumuman', compact('data_pengumuman'));
    }

    public function detailPengumuman($id_pengumuman){
    	$data_pengumuman = Pengumuman::where('id', $id_pengumuman)->get();
    	return view('siswa.pengumuman', compact('data_pengumuman'));
    }
}
