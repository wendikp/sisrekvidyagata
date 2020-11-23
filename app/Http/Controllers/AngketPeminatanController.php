<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AngketPeminatanSiswa;
use App\Kriteria;
use App\NilaiPeminatan;
use App\RekomendasiPeminatan;

class AngketPeminatanController extends Controller
{

    public function storeAngketPeminatan(Request $data, $id_user){
    	$jumlah_baris = count($data->id_kriteria);
    	for ($i=0; $i < $jumlah_baris; $i++) { 
    		$baris = AngketPeminatanSiswa::where('id_kriteria', $data->id_kriteria[$i]);
    		$baris->create([
    			'nilai'       => $data->nilai[$i],
    			'id_kriteria' => $data->id_kriteria[$i],
    			'id_user'     => $id_user
    			]);
    	}
    	return redirect('/homepage');
    }

    public function showAngketPeminatanSiswa($angkatan){
        // Mengambil nama kriteria untuk th table ===============================
        $data_record_kriteria_peminatan = DB::table('record_kriteria_peminatan')->select('id_kriteria_peminatan')->where('angkatan', $angkatan)->first();
        $id_kriteria_peminatan = $data_record_kriteria_peminatan->id_kriteria_peminatan;
        $header_kriteria = Kriteria::select('kriteria')->where('id_kriteria_peminatan', $id_kriteria_peminatan)->get();

        // Melakukan pengecekkan apakah bobot preferensi sudah ditentukan =======
        $data_kriteria_peminatan = DB::table('kriteria_peminatan')->select('status_bobot')->where('deleted_at', NULL)->first();
        $status_bobot = $data_kriteria_peminatan->status_bobot;
        
        // Mengambil data siswa =================================================
        $data_siswa = DB::table('users')
        ->join('angket_peminatan', 'angket_peminatan.id_user', '=', 'users.id')
        ->select('users.id', 'no_induk', 'name')
        ->where([
            ['role', 'Siswa'], 
            ['angkatan', $angkatan]])
        ->groupBy('angket_peminatan.id_user', 'users.id', 'no_induk', 'name')
        ->get();

        $l=0;
        $id = [];
        $no_induk = [];
        $name = [];
        foreach ($data_siswa as $data) {
            $id[] = $data->id;
            $no_induk[] = $data->no_induk;
            $name[] = $data->name;
            $l++;
        }

        // id siswa untuk mengambil data angket peminatan =======================
        $id_siswa = DB::table('users')->select('id')->where([['angkatan', $angkatan], ['deleted_at', NULL]]);
        // Mengambil data angket peminatan
        $data_angket = AngketPeminatanSiswa::select('nilai', 'id_kriteria', 'id_user')->whereIn('id_user', $id_siswa)->get();

        $nilai = [];
        $id_user = [];
        foreach ($data_angket as $data) {
            $nilai[] = $data->nilai;
            $id_user[] = $data->id_user;
        }

        // Memasukkan data angket peminatan ke variabel =========================
        for ($i=0; $i < count($id); $i++) { 
            $angket_peminatan[$i][0] = $id[$i]; $angket_peminatan[$i][1] = $no_induk[$i]; $angket_peminatan[$i][2] = $name[$i];
        }

        $k = 0;
        for ($i=0; $i < count($id); $i++) {
            $k=3; 
            for ($j=0; $j < count($nilai); $j++) { 
                if ($id[$i] == $id_user[$j]) {
                    $angket_peminatan[$i][$k] = $nilai[$j];
                    $k++;
                }
            }
        }

        // menentukan jumlah baris dan kolom untuk memudahkan dalam memasukkan data =============================================
        if($angket_peminatan == 0){
            $baris = 0;
        } else {
            $baris = count($angket_peminatan);
        }
        $kolom = $k;


        // Memastikan semua siswa sudah mengisi angket peminatan ============================================================
        $jml_siswa_angkatan = DB::table('users')->select('id')->where([['angkatan', $angkatan],['deleted_at', NULL]])->count();
        $jml_siswa_sudah_mengisi_angket = count(AngketPeminatanSiswa::select('id_user')->whereIn('id_user', $id_siswa)->groupBy('id_user')->get());
        
        if ($jml_siswa_angkatan == $jml_siswa_sudah_mengisi_angket) {
            $tombol_rekomendasi = "on";
        } else {
            $tombol_rekomendasi = "off";
        }

        return view('tim_ppdb.daftar_angket_peminatan_siswa', compact('header_kriteria', 'angket_peminatan', 'id', 'angkatan', 'baris', 'kolom', 'tombol_rekomendasi', 'status_bobot'));
    }

    public function exportAngketPeminatan($angkatan){
        // Mengambil nama kriteria untuk th table ===============================
        $data_record_kriteria_peminatan = DB::table('record_kriteria_peminatan')->select('id_kriteria_peminatan')->where('angkatan', $angkatan)->first();
        $id_kriteria_peminatan = $data_record_kriteria_peminatan->id_kriteria_peminatan;
        $header_kriteria = Kriteria::select('kriteria')->where('id_kriteria_peminatan', $id_kriteria_peminatan)->get();
        
        // Mengambil data siswa =================================================
        $data_siswa = DB::table('users')
        ->join('angket_peminatan', 'angket_peminatan.id_user', '=', 'users.id')
        ->select('users.id', 'no_induk', 'name')
        ->where([
            ['role', 'Siswa'], 
            ['angkatan', $angkatan]])
        ->groupBy('angket_peminatan.id_user', 'users.id', 'no_induk', 'name')
        ->get();

        $l=0;
        $id = [];
        $no_induk = [];
        $name = [];
        foreach ($data_siswa as $data) {
            $id[] = $data->id;
            $no_induk[] = $data->no_induk;
            $name[] = $data->name;
            $l++;
        }

        // id siswa untuk mengambil data angket peminatan =======================
        $id_siswa = DB::table('users')->select('id')->where([['angkatan', $angkatan], ['deleted_at', NULL]]);
        // Mengambil data angket peminatan
        $data_angket = AngketPeminatanSiswa::select('nilai', 'id_kriteria', 'id_user')->whereIn('id_user', $id_siswa)->get();

        $nilai = [];
        $id_user = [];
        foreach ($data_angket as $data) {
            $nilai[] = $data->nilai;
            $id_user[] = $data->id_user;
        }

        // Memasukkan data angket peminatan ke variabel =========================
        for ($i=0; $i < count($id); $i++) { 
            $angket_peminatan[$i][0] = $id[$i]; $angket_peminatan[$i][1] = $no_induk[$i]; $angket_peminatan[$i][2] = $name[$i];
        }

        for ($i=0; $i < count($id); $i++) {
            $k=3; 
            for ($j=0; $j < count($nilai); $j++) { 
                if ($id[$i] == $id_user[$j]) {
                    $angket_peminatan[$i][$k] = $nilai[$j];
                    $k++;
                }
            }
        }

        // menentukan jumlah baris dan kolom untuk memudahkan dalam memasukkan data =============================================
        $baris = count($angket_peminatan);
        $kolom = $k;

        // FUngsi header dengan mengirimkan raw data excel
        header("Content-type: application/vnd-ms-excel");
        // Mendefinisikan nama file
        header("Content-Disposition: attachment; filename=Angket Peminatan Siswa ".$angkatan.".xls");
        // tabel
        echo '
        <table border="1">
            <thead>
                <tr>
                    <td colspan="'; echo $kolom; echo '"><b>Angket Peminatan Siswa Baru Angkatan '; echo $angkatan; echo '</b></td>
                </tr>
                <tr>
                  <th>No.</th>
                  <th>No. Induk</th>
                  <th>Nama</th>';
                  foreach($header_kriteria as $data){
                      echo '<th>'; echo $data->kriteria; echo '</th>';
                  }
                  echo '
              </tr>
          </thead>
          <tbody>';
            for($i=0; $i < $baris; $i++){
                echo '<tr>';
                for($j=0; $j < $kolom; $j++){
                  if ($j == 0){
                      echo '<td>'; echo ($i+1); echo '</td>';
                      $j++;
                  }
                  echo '<td>'; echo $angket_peminatan[$i][$j]; echo '</td>';
              }
              echo '</tr>';
          }
          echo '</tbody> 
      </table>
      ';
  }

  public function editAngketPeminatanSiswa($id_user){
    $data_angket = DB::table('kriteria')
    ->join('angket_peminatan', 'angket_peminatan.id_kriteria', '=', 'kriteria.id')
    ->select('kriteria.id', 'kriteria.kriteria', 'kriteria.kategori', 'angket_peminatan.nilai')
    ->where([
        ['kriteria.deleted_at', '=', NULL], 
        ['angket_peminatan.id_user', '=', $id_user]
        ])
    ->get();

    $siswa = DB::table('users')->select('angkatan', 'name')->where('users.id', $id_user)->first();
    $angkatan = $siswa->angkatan;
    $nama = $siswa->name;
    return view('tim_ppdb.edit_angket_peminatan_siswa', compact('data_angket', 'angkatan', 'id_user', 'nama'));
}

public function updateAngketPeminatan_TimPPDB(Request $data, $id){
    $jumlah_baris = count($data->id_kriteria);
    for ($i=0; $i < $jumlah_baris ; $i++) { 
        $baris = AngketPeminatanSiswa::where([
            ['id_kriteria', $data->id_kriteria[$i]], 
            ['id_user', $id]
            ]);
        $baris->update([
            'nilai' => $data->nilai[$i]
            ]);
    }
    return redirect('/angket_peminatan/angkatan_siswa/angket/edit/'.$id);
}




public function showAngketPeminatan($id_user){
 $data_angket = DB::table('kriteria')
 ->join('angket_peminatan', 'angket_peminatan.id_kriteria', '=', 'kriteria.id')
 ->select('kriteria.kriteria', 'angket_peminatan.nilai')
 ->where([
  ['kriteria.deleted_at', '=', NULL], 
  ['angket_peminatan.id_user', '=', $id_user]
  ])
 ->get();
 return view('siswa.angket_peminatan', compact('data_angket'));
}

public function updateAngketPeminatan(Request $data, $id){
 $jumlah_baris = count($data->id_kriteria);
 for ($i=0; $i < $jumlah_baris ; $i++) { 
  $baris = AngketPeminatanSiswa::where([
   ['id_kriteria', $data->id_kriteria[$i]], 
   ['id_user', $id]
   ]);
  $baris->update([
   'nilai' => $data->nilai[$i]
   ]);
}
return redirect('/homepage');
}

public function rekomendasiPeminatan($id_user){
    $data_siswa = DB::table('users')
    ->join('rombel', 'rombel.id', '=', 'users.id_rombel')
    ->select('users.no_induk', 'users.name', 'rombel.nama_rombel', 'rombel.wali_kelas', DB::raw('UPPER(rombel.peminatan) AS peminatan'))
    ->where('users.id', $id_user)
    ->get();
    return view('siswa.rekomendasi_peminatan', compact('data_siswa'));
}

public function daftarRekomendasiPeminatan($angkatan){
    $data_rekomendasi = DB::table('users')
    ->select(
        'users.no_induk',
        'users.name',
        'nilai_peminatan.nilai_ipa',
        'nilai_peminatan.nilai_ips',
        'nilai_peminatan.nilai_bahasa',
        'rekomendasi_peminatan.rekomendasi_1',
        'rekomendasi_peminatan.rekomendasi_2',
        'rekomendasi_peminatan.rekomendasi_3'
        )
    ->join('nilai_peminatan', 'users.id', '=', 'nilai_peminatan.id_user')
    ->join('rekomendasi_peminatan', 'users.id', '=', 'rekomendasi_peminatan.id_user')
    ->groupBy(
        'users.no_induk',
        'users.name',
        'nilai_peminatan.nilai_ipa',
        'nilai_peminatan.nilai_ips',
        'nilai_peminatan.nilai_bahasa',
        'rekomendasi_peminatan.rekomendasi_1',
        'rekomendasi_peminatan.rekomendasi_2',
        'rekomendasi_peminatan.rekomendasi_3'
        )
    ->where('users.angkatan', $angkatan)
    ->get();

    return view('tim_ppdb.daftar_rekomendasi_peminatan_siswa', compact('data_rekomendasi', 'angkatan'));
}

public function exportDataRekomendasi($angkatan){
    $data_rekomendasi = DB::table('users')
    ->select(
        'users.no_induk',
        'users.name',
        'nilai_peminatan.nilai_ipa',
        'nilai_peminatan.nilai_ips',
        'nilai_peminatan.nilai_bahasa',
        'rekomendasi_peminatan.rekomendasi_1',
        'rekomendasi_peminatan.rekomendasi_2',
        'rekomendasi_peminatan.rekomendasi_3'
        )
    ->join('nilai_peminatan', 'users.id', '=', 'nilai_peminatan.id_user')
    ->join('rekomendasi_peminatan', 'users.id', '=', 'rekomendasi_peminatan.id_user')
    ->where('users.angkatan', $angkatan)
    ->get();

        // FUngsi header dengan mengirimkan raw data excel
    header("Content-type: application/vnd-ms-excel");
        // Mendefinisikan nama file
    header("Content-Disposition: attachment; filename=Hasil Rekomendasi Peminatan Siswa ".$angkatan.".xls");
        // tabel
    echo '
    <table border="1">
        <tr>
            <th>No.</th>
            <th>No. Induk</th>
            <th>Nama</th>
            <th>Nilai Peminatan IPA</th>
            <th>Nilai Peminatan IPS</th>
            <th>Nilai Peminatan Bahasa</th>
            <th>Rekomendasi Pertama</th>
            <th>Rekomendasi Kedua</th>
            <th>Rekomendasi Ketiga</th>
        </tr>
        '; 
        $i=1;
        foreach($data_rekomendasi as $data){ echo '
            <tr>
                <td>'; echo $i++; echo '</td>
                <td>'; echo $data->no_induk; echo '</td>
                <td>'; echo $data->name; echo '</td>
                <td>'; echo $data->nilai_ipa; echo '</td>
                <td>'; echo $data->nilai_ips; echo '</td>
                <td>'; echo $data->nilai_bahasa; echo '</td>
                <td>'; echo $data->rekomendasi_1; echo '</td>
                <td>'; echo $data->rekomendasi_2; echo '</td>
                <td>'; echo $data->rekomendasi_3; echo '</td>
            </tr>';
        }
        if (count($data_rekomendasi) <= 0) { echo '         
            <tr>
                <td colspan="9" align="center">Belum Ada Data</td>
            </tr>';
        } echo ' 
    </table>
    ';

}

    // perhitungan menggunakan metode saw
public function hasilkanRekomendasi($angkatan){
        // mengambil kriteria yang digunakan
    $data_record_kriteria = DB::table('record_kriteria_peminatan')->select('id_kriteria_peminatan')->where('angkatan', $angkatan)->first();
    $id_kriteria_peminatan = $data_record_kriteria->id_kriteria_peminatan;

    $kriteria = Kriteria::where('id_kriteria_peminatan', $id_kriteria_peminatan)->get();

    $jml_kriteria = count($kriteria);
    $id_siswa = DB::table('users')->select('id')->where('angkatan', $angkatan);
    $jml_siswa = count(DB::table('users')->select('id')->where('angkatan', $angkatan)->get());

        // mengambil angket peminatan siswa
    $angket_peminatan = AngketPeminatanSiswa::whereIn('id_user', $id_siswa)->get();
    $data_siswa = AngketPeminatanSiswa::select('id_user')->whereIn('id_user', $id_siswa)->get();

        // memasukkan nilai ke dalam array dimensi 1 sebelum diubah menjadi matriks
    $indeks = 0;
    foreach ($angket_peminatan as $data) {
        $nilai_siswa[$indeks] = $data->nilai;
        $indeks++;
    }

        //---- mengubah nilai siswa ke dalam rating kecocokan lalu memasukkan nilai ke dalam matriks 2 dimensi untuk memudahkan perhitungan
    $indeks = 0;
    for ($i=0; $i < $jml_siswa; $i++) { 
        for ($j=0; $j < $jml_kriteria; $j++) { 
                // untuk nilai siswa berupa angka
            if (is_numeric($nilai_siswa[$indeks])) {
                if (($nilai_siswa[$indeks] > 90) && ($nilai_siswa[$indeks] <= 100)) {
                    $nilai[$i][$j] = 5;
                } elseif (($nilai_siswa[$indeks] > 85) && ($nilai_siswa[$indeks] <= 90)) {
                    $nilai[$i][$j] = 4;
                } elseif (($nilai_siswa[$indeks] > 70) && ($nilai_siswa[$indeks] <= 85)) {
                    $nilai[$i][$j] = 3;
                } elseif (($nilai_siswa[$indeks] > 65) && ($nilai_siswa[$indeks] <= 70)) {
                    $nilai[$i][$j] = 2;
                } elseif (($nilai_siswa[$indeks] >= 0) && ($nilai_siswa[$indeks] <= 65)) {
                    $nilai[$i][$j] = 1;
                }
            } else {
                if ($nilai_siswa[$indeks] == "Sangat minat") {
                    $nilai[$i][$j] = 5;
                } elseif ($nilai_siswa[$indeks] == "Minat") {
                    $nilai[$i][$j] = 4;
                } elseif ($nilai_siswa[$indeks] == "Cukup") {
                    $nilai[$i][$j] = 3;
                } elseif ($nilai_siswa[$indeks] == "Kurang minat") {
                    $nilai[$i][$j] = 2;
                } else {
                    $nilai[$i][$j] = 1;
                }
            }
            $indeks++;
        }
    }

        //------- melakukan normalisasi matriks
    for ($i=0; $i < $jml_kriteria; $i++) { 
        $jumlah_nilai_kolom[$i] = 0;
    }

    for ($i=0; $i < $jml_kriteria; $i++) { 
        $nilai_max[$i] = 0;
        for ($j=0; $j < $jml_siswa; $j++) { 
            if ($nilai_max[$i] > $nilai[$j][$i]) {
                $nilai_max[$i] = $nilai_max[$i];
            } else {
                $nilai_max[$i] = $nilai[$j][$i];
            }
        }
    }

    for ($i=0; $i < $jml_siswa; $i++) { 
        for ($j=0; $j < $jml_kriteria; $j++) { 
            $x[$i][$j] = $nilai[$i][$j]/$nilai_max[$j];
        }
    }

        // ------ Menghitung nilai preferensi peminatan
    $i = 0;
    foreach ($kriteria as $data) {
        $bobot_prioritas_ipa[$i] = $data->bobot_prioritas_ipa;
        $bobot_prioritas_ips[$i] = $data->bobot_prioritas_ips;
        $bobot_prioritas_bhs[$i] = $data->bobot_prioritas_bhs;
        $i++;
    }

    $i = 0;
    foreach ($data_siswa as $data) {
        $siswa[$i] = $data->id_user;
        $i++;
    }

        // mengambil id siswa agar sesuai dengan urutan data yang masuk di tabel angket peminatan
    $j = 0;
    for ($i=0; $i < $jml_siswa; $i++) { 
        $id_user_siswa[$i] = $siswa[$j];
        $j += $jml_kriteria;
    }

    for ($i=0; $i < $jml_siswa; $i++) { 
        $nilai_preferensi_ipa[$i] = 0;
        $nilai_preferensi_ips[$i] = 0;
        $nilai_preferensi_bhs[$i] = 0;
    }

    for ($i=0; $i < $jml_siswa; $i++) { 
        for ($j=0; $j < $jml_kriteria; $j++) { 
            $nilai_preferensi_ipa[$i] += $x[$i][$j] * $bobot_prioritas_ipa[$j];
            $nilai_preferensi_ips[$i] += $x[$i][$j] * $bobot_prioritas_ips[$j];
            $nilai_preferensi_bhs[$i] += $x[$i][$j] * $bobot_prioritas_bhs[$j];
        }
    }

        // memasukkan data ke tabel nilai peminatan
    for ($i=0; $i < $jml_siswa; $i++) { 
        NilaiPeminatan::create([
            'id_user'      => $id_user_siswa[$i],
            'nilai_ipa'    => $nilai_preferensi_ipa[$i],
            'nilai_ips'    => $nilai_preferensi_ips[$i],
            'nilai_bahasa' => $nilai_preferensi_bhs[$i]
            ]);
    }

        // ----- Mengurutkan nilai preferensi siswa
    for ($i=0; $i < $jml_siswa; $i++) {
        $urutan_nilai_preferensi[$i] = array($nilai_preferensi_ipa[$i], $nilai_preferensi_ips[$i], $nilai_preferensi_bhs[$i]);
        rsort($urutan_nilai_preferensi[$i]);
    }

    for ($i=0; $i < $jml_siswa; $i++) { 
        if ($urutan_nilai_preferensi[$i][0] == $nilai_preferensi_ipa[$i]) {
            $rekomendasi_1[$i] = 'MIPA';
            if ($urutan_nilai_preferensi[$i][1] == $nilai_preferensi_ips[$i]) {
                $rekomendasi_2[$i] = 'IPS';
                $rekomendasi_3[$i] = 'Bahasa dan Budaya';
            } else {
                $rekomendasi_2[$i] = 'Bahasa dan Budaya';
                $rekomendasi_3[$i] = 'IPS';
            }
        } elseif ($urutan_nilai_preferensi[$i][0] == $nilai_preferensi_ips[$i]) {
            $rekomendasi_1[$i] = 'IPS';
            if ($urutan_nilai_preferensi[$i][1] == $nilai_preferensi_ipa[$i]) {
                $rekomendasi_2[$i] = 'MIPA';
                $rekomendasi_3[$i] = 'Bahasa dan Budaya';
            } else {
                $rekomendasi_2[$i] = 'Bahasa dan Budaya';
                $rekomendasi_3[$i] = 'MIPA';
            }
        } else {
            $rekomendasi_1[$i] = 'Bahasa dan Budaya';
            if ($urutan_nilai_preferensi[$i][1] == $nilai_preferensi_ipa[$i]) {
                $rekomendasi_2[$i] = 'MIPA';
                $rekomendasi_3[$i] = 'IPS';
            } else {
                $rekomendasi_2[$i] = 'IPS';
                $rekomendasi_3[$i] = 'IPA';
            }
        }
    }

        // memasukkan data ke tabel rekomendasi peminatan
    for ($i=0; $i < $jml_siswa; $i++) { 
        RekomendasiPeminatan::create([
            'id_user'       => $id_user_siswa[$i],
            'rekomendasi_1' => $rekomendasi_1[$i],
            'rekomendasi_2' => $rekomendasi_2[$i],
            'rekomendasi_3' => $rekomendasi_3[$i]
            ]);
    }

    return redirect('/angket_peminatan/angkatan_siswa/daftar_rekomendasi/'.$angkatan);

}

}
