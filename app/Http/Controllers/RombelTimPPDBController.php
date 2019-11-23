<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rombel;
use App\User;

class RombelTimPPDBController extends Controller
{

    public function showRombel(){
        $data_rombel = Rombel::select('tahun_ajar', DB::raw('count(id) as jumlah_rombel'))->groupBy('tahun_ajar')->orderBy('tahun_ajar', 'desc')->get();
        return view('tim_ppdb.tahun_ajaran', compact('data_rombel'));
    }

    public function showRombelTahunAjaran($tahun_ajaran){
        $data_rombel = Rombel::select('id', 'peminatan', 'nama_rombel', 'wali_kelas', 'jumlah_siswa', 'kuota_kelas')->where('tahun_ajar', $tahun_ajaran)->orderBy('peminatan')->get();
        return view('tim_ppdb.daftar_rombel', compact('data_rombel', 'tahun_ajaran'));
    }

    public function showRombelIPA(){
      $data_rombel = Rombel::where('peminatan', 'ipa')->orderBy('tahun_ajar', 'desc')->get();
      return view('tim_ppdb.daftar_rombel_ipa', compact('data_rombel'));
  }

  public function showRombelIPS(){
      $data_rombel = Rombel::where('peminatan', 'ips')->orderBy('tahun_ajar', 'desc')->get();
      return view('tim_ppdb.daftar_rombel_ips', compact('data_rombel'));
  }

  public function showRombelBahasa(){
      $data_rombel = Rombel::where('peminatan', 'bahasa')->orderBy('tahun_ajar', 'desc')->get();
      return view('tim_ppdb.daftar_rombel_bahasa', compact('data_rombel'));
  }

  public function storeSiswaRombel(Request $data){
     $jumlah_baris = count($data->id);

     for ($i=0; $i < $jumlah_baris; $i++) { 
      $id_rombel = $data->id_rombel[$i];
      $siswa = User::where('id', $id_siswa[$i]);
      $siswa->update([
          'id_rombel' => $data->id_rombel[$i]
          ]);
  }

  return redirect('/show_absensi/'.$id_rombel);
}

    //belum diuji
public function showAbsensi($id_rombel){
 $data_rombel = Rombel::select('id', 'nama_rombel', 'wali_kelas', 'tahun_ajar', 'peminatan')->where('id', $id_rombel)->first();

 $data_siswa_rombel = DB::table('users')
 ->join('nilai_peminatan', 'nilai_peminatan.id_user', '=', 'users.id')
 ->join('rekomendasi_peminatan', 'rekomendasi_peminatan.id_user', '=', 'users.id')
 ->select(
  'users.*', 
  'nilai_peminatan.nilai_ipa',
  'nilai_peminatan.nilai_ips',
  'nilai_peminatan.nilai_bahasa',
  'rekomendasi_peminatan.rekomendasi_1',
  'rekomendasi_peminatan.rekomendasi_2',
  'rekomendasi_peminatan.rekomendasi_3'
  )
 ->where([
    ['users.id_rombel', '=', $id_rombel],
    ['users.deleted_at', '=', NULL]
    ])
 ->get();

 if ($data_rombel->peminatan == 'MIPA') {
  $data_daftar_siswa = DB::table('users')
  ->join('nilai_peminatan', 'nilai_peminatan.id_user', '=', 'users.id')
  ->join('rekomendasi_peminatan', 'rekomendasi_peminatan.id_user', '=', 'users.id')
  ->select(
      'users.*', 
      'nilai_peminatan.nilai_ipa', 
      'nilai_peminatan.nilai_ips', 
      'nilai_peminatan.nilai_bahasa',
      'rekomendasi_peminatan.rekomendasi_1',
      'rekomendasi_peminatan.rekomendasi_2',
      'rekomendasi_peminatan.rekomendasi_3'
      )
  ->where([
    ['users.id_rombel', '=', NULL],
    ['users.deleted_at', '=', NULL],
    ['users.angkatan', '=', $data_rombel->tahun_ajar]
    ])
  ->orderBy('nilai_peminatan.nilai_ipa', 'DESC')
  ->get();
} elseif ($data_rombel->peminatan == 'IPS') {
  $data_daftar_siswa = DB::table('users')
  ->join('nilai_peminatan', 'nilai_peminatan.id_user', '=', 'users.id')
  ->join('rekomendasi_peminatan', 'rekomendasi_peminatan.id_user', '=', 'users.id')
  ->select(
      'users.*', 
      'nilai_peminatan.nilai_ipa', 
      'nilai_peminatan.nilai_ips', 
      'nilai_peminatan.nilai_bahasa',
      'rekomendasi_peminatan.rekomendasi_1',
      'rekomendasi_peminatan.rekomendasi_2',
      'rekomendasi_peminatan.rekomendasi_3'
      )
  ->where([
    ['users.id_rombel', '=', NULL],
    ['users.deleted_at', '=', NULL],
    ['users.angkatan', '=', $data_rombel->tahun_ajar]
    ])
  ->orderBy('nilai_peminatan.nilai_ips', 'DESC')
  ->get();
} else {
  $data_daftar_siswa = DB::table('users')
  ->join('nilai_peminatan', 'nilai_peminatan.id_user', '=', 'users.id')
  ->join('rekomendasi_peminatan', 'rekomendasi_peminatan.id_user', '=', 'users.id')
  ->select(
      'users.*', 
      'nilai_peminatan.nilai_ipa', 
      'nilai_peminatan.nilai_ips', 
      'nilai_peminatan.nilai_bahasa',
      'rekomendasi_peminatan.rekomendasi_1',
      'rekomendasi_peminatan.rekomendasi_2',
      'rekomendasi_peminatan.rekomendasi_3'
      )
  ->where([
    ['users.id_rombel', '=', NULL],
    ['users.deleted_at', '=', NULL],
    ['users.angkatan', '=', $data_rombel->tahun_ajar]
    ])
  ->orderBy('nilai_peminatan.nilai_bahasa', 'DESC')
  ->get();
}

return view('tim_ppdb.absensi', compact('data_siswa_rombel','data_daftar_siswa', 'data_rombel', 'id_rombel'));
}

public function addSiswa(Request $data){
    $jumlah_data = count($data->id);
    $id_rombel = $data->id_rombel;

    for ($i=0; $i < $jumlah_data; $i++) { 
        $baris_user = User::where('id', $data->id[$i]);
        $baris_user->update([
            'id_rombel' => $id_rombel
            ]);
    }

    $baris_rombel = Rombel::where('id', $id_rombel);
    $data_rombel = Rombel::select('jumlah_siswa')->where('id', $id_rombel)->get();

    foreach ($data_rombel as $data) {
        $jumlah_siswa = $data->jumlah_siswa;
    }

    $baris_rombel->update([
        'jumlah_siswa' => ($jumlah_siswa + $jumlah_data)
        ]);


    return redirect('/daftar_rombel/absensi/'.$id_rombel);
}

public function deleteSiswa($id_siswa){
    $data_user = DB::table('users')
    ->join('rombel', 'rombel.id', '=', 'users.id_rombel')
    ->select('users.id_rombel', 'rombel.jumlah_siswa')
    ->where('users.id', $id_siswa)
    ->get();

    foreach ($data_user as $data) {
        $id_rombel = $data->id_rombel;
        $jumlah_siswa = $data->jumlah_siswa;
    }

    $siswa = User::where('id', $id_siswa);
    $siswa->update([
        'id_rombel' => NULL
        ]);

    $rombel = Rombel::where('id', $id_rombel);
    $rombel->update([
        'jumlah_siswa' => ($jumlah_siswa - 1)
        ]);

    return redirect('/daftar_rombel/absensi/'.$id_rombel);
}

public function exportDaftarSiswa($id_rombel){
    $data_rombel = Rombel::select('id', 'nama_rombel', 'wali_kelas', 'tahun_ajar', 'peminatan')->where('id', $id_rombel)->first();
    $data_siswa = DB::table('users')
    ->select(
        'no_induk', 
        'name', 
        DB::raw('DAY(tgl_lahir) AS day'),
        DB::raw('MONTH(tgl_lahir) AS month'),
        DB::raw('YEAR(tgl_lahir) AS year'),
        'jenis_kelamin',
        'email',
        'no_telepon',
        'alamat')
    ->where([
        ['id_rombel', $id_rombel],
        ['deleted_at', NULL]
        ])
    ->orderBy('name', 'asc')
    ->get();

    // FUngsi header dengan mengirimkan raw data excel
    header("Content-type: application/vnd-ms-excel");
    // Mendefinisikan nama file
    header("Content-Disposition: attachment; filename=Daftar Siswa ".$data_rombel->peminatan." - ".$data_rombel->nama_rombel." Angkatan ".$data_rombel->tahun_ajar.".xls");
    // tabel
    echo '
    <table border="1">
        <thead>
            <tr>
                <td colspan="8"><b>Daftar Siswa '; echo $data_rombel->peminatan." - ".$data_rombel->nama_rombel." Angkatan ".$data_rombel->tahun_ajar; echo '</b></td>
            </tr>
            <tr>
              <th>No.</th>
              <th>No. Induk</th>
              <th>Nama</th>
              <th>Tanggal lahir</th>
              <th>Jenis Kelamin</th>
              <th>Email</th>
              <th>No. HP/Telepon</th>
              <th>Alamat</th>
          </tr>
      </thead>
      <tbody>';
          $i=1;
          foreach ($data_siswa as $data) {
              echo '
              <tr>
                  <td>'; echo $i ; echo '</td>
                  <td>'; echo $data->no_induk; echo '</td>
                  <td>'; echo $data->name; echo '</td>
                  <td>'; echo "$data->day-$data->month-$data->year"; echo '</td>
                  <td>'; 
                  if ($data->jenis_kelamin == "L") {
                      echo "Laki - laki";
                  } else {
                      echo "Perempuan";
                  }
                  echo '
                  </td>
                  <td>'; echo $data->email; echo '</td>
                  <td>'; echo $data->no_telepon; echo '</td>
                  <td>'; echo $data->alamat; echo '</td>
              </tr>';
              $i++;
          }
          echo '</tbody> 
      </table>
      ';
  }

}
