<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecordKriteriaPeminatan;
use Illuminate\Support\Facades\DB;

class RecordKriteriaPeminatanController extends Controller
{
    public function pilihKriteriaPeminatan($angkatan){
    	$data_kriteria_peminatan = DB::table('kriteria_peminatan')->select('id', 'kode_kriteria', 'jumlah', 'status_bobot')->orderBy('created_at', 'desc')->where('deleted_at', NULL)->get();
    	return view('tim_ppdb.pilih_kriteria_peminatan', compact('angkatan', 'data_kriteria_peminatan'));
    }

    public function simpanKriteriaPeminatan(Request $data, $angkatan){
    	$data_peminatan_angkatan = RecordKriteriaPeminatan::select('angkatan')->where('angkatan', $angkatan)->first();
    	
    	if ($data_peminatan_angkatan == NULL) {
    		RecordKriteriaPeminatan::create([
    		'id_kriteria_peminatan' => $data->pilihan,
    		'angkatan'              => $angkatan
    		]);
    	} else {
    		$update_data = RecordKriteriaPeminatan::where('angkatan', $angkatan);
    		$update_data->update([
    			'id_kriteria_peminatan' => $data->pilihan,
    			]);
    	}

    	return redirect('/angket_peminatan/angkatan_siswa');
    }
}
