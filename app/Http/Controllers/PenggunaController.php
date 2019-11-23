<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kriteria;
use App\KriteriaPeminatan;
use App\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{

    public function barchart(){
        return view('admin.barChart');
    }
    public function index(){
        // Mendapatkan jumlah akun masing-masing jenis pengguna yang aktif di sistem
        $jml_admin = User::select('id')->where('role', 'Admin')->count();
        $jml_waka = User::select('id')->where('role', 'Waka Kurikulum')->count();
        $jml_timppdb = User::select('id')->where('role', 'Tim PPDB')->count();
        $jml_siswa = User::select('id')->where('role', 'Siswa')->count();

        // Menyiapkan data untuk bar chart jumlah siswa tiap tahun
        $data_siswa = User::select(
            DB::raw('COUNT(id) as jml_siswa'),
            'angkatan'
            )->where('role', 'siswa')->groupBy('angkatan')->orderBy('angkatan', 'asc')->get();

        $angkatan = [];
        $jumlah = [];

        foreach ($data_siswa as $data) {
            $angkatan[] = $data->angkatan;
            $jumlah[] = $data->jml_siswa;
        }

        // Menyiapkan data admin untuk bagian profil
        $data_admin = User::where('id', Auth::user()->id)->get();

        return view('admin.dashboard', compact('jml_admin', 'jml_waka', 'jml_timppdb', 'jml_siswa', 'angkatan', 'jumlah', 'data_admin'));
    }

    public function dashboardWakaKurikulum(){
        // Menyiapkan data rombel tiap peminatan
        $data_siswa = User::select('angkatan')->where('role', 'Siswa')->groupBy('angkatan')->orderBy('angkatan', 'desc')->first();
        if (is_null($data_siswa)) {
            $tahun_ajar_baru = null;
        } else {
            $tahun_ajar_baru = $data_siswa->angkatan;
        }

        $jml_rombel_ipa = DB::table('rombel')->select('id')->where([['deleted_at', null], ['peminatan', 'MIPA'], ['tahun_ajar', $tahun_ajar_baru]])->count();
        $jml_rombel_ips = DB::table('rombel')->select('id')->where([['deleted_at', null], ['peminatan', 'IPS'], ['tahun_ajar', $tahun_ajar_baru]])->count();
        $jml_rombel_bhs = DB::table('rombel')->select('id')->where([['deleted_at', null], ['peminatan', 'Bahasa dan Budaya'], ['tahun_ajar', $tahun_ajar_baru]])->count();

        // Menyiapkan data untuk bar chart rombel peminatan tiap tahun
        $tahun_ajaran = [];
        $rombel_ipa = [];
        $rombel_ips = [];
        $rombel_bhs = [];

        $data_rombel = DB::table('rombel')->select('tahun_ajar')->where('deleted_at', null)->groupBy('tahun_ajar')->orderBy('tahun_ajar', 'asc')->get();
        foreach ($data_rombel as $data) {
           $tahun_ajaran[] = $data->tahun_ajar;
       }

       $data_rombel = DB::table('rombel')->select(
        DB::raw('COUNT(id) as jml_rombel')
        )
       ->where([
        ['deleted_at', null],
        ['peminatan', 'MIPA']
        ])
       ->groupBy('tahun_ajar')
       ->orderBy('tahun_ajar', 'asc')
       ->get();
       foreach ($data_rombel as $data) {
           $rombel_ipa[] = $data->jml_rombel;
       }

       $data_rombel = DB::table('rombel')->select(
        DB::raw('COUNT(id) as jml_rombel')
        )
       ->where([
        ['deleted_at', null],
        ['peminatan', 'IPS']
        ])
       ->groupBy('tahun_ajar')
       ->orderBy('tahun_ajar', 'asc')
       ->get();
       foreach ($data_rombel as $data) {
           $rombel_ips[] = $data->jml_rombel;
       }

       $data_rombel = DB::table('rombel')->select(
        DB::raw('COUNT(id) as jml_rombel')
        )
       ->where([
        ['deleted_at', null],
        ['peminatan', 'Bahasa dan Budaya']
        ])
       ->groupBy('tahun_ajar')
       ->orderBy('tahun_ajar', 'asc')
       ->get();
       foreach ($data_rombel as $data) {
           $rombel_bhs[] = $data->jml_rombel;
       }

        // Mengambil data user yang login
       $data_waka = User::where('id', (Auth::user()->id))->get();

       return view('waka_kurikulum.dashboard', compact('jml_rombel_ipa','jml_rombel_ips','jml_rombel_bhs','tahun_ajar_baru','data_waka','tahun_ajaran','rombel_ipa','rombel_ips','rombel_bhs'));
   }

   public function dashboardTimPPDB(){
        // Mengambil data user yang login
    $data_tim = User::where('id', (Auth::user()->id))->get();
        // mencari angkatan terbaru
    $angkatan_baru = User::select('angkatan')->orderBy('angkatan', 'desc')->limit(1)->first();

        // mencari total siswa angkatan baru
    $total_siswa = User::select(DB::raw('COUNT(id) as total'))
    ->where([
        ['role', 'Siswa'], 
        ['angkatan', $angkatan_baru->angkatan] 
        ])
    ->first();
    $total = $total_siswa->total;

        // mencari jumlah siswa ipa, ips, bahasa untuk angkatan baru
    $siswa = DB::table('rombel')
    ->select(DB::raw('SUM(jumlah_siswa) as jumlah'))
    ->join('users', 'users.id_rombel', '=', 'rombel.id')
    ->where([ ['peminatan', 'MIPA'], ['tahun_ajar', $angkatan_baru->angkatan] ])
    ->first();
    if ($siswa->jumlah == null) {
        $jumlah_siswa_ipa = 0;
    } else {
        $jumlah_siswa_ipa = $siswa->jumlah;
    }

    $siswa = DB::table('rombel')
    ->select(DB::raw('SUM(jumlah_siswa) as jumlah'))
    ->join('users', 'users.id_rombel', '=', 'rombel.id')
    ->where([ ['peminatan', 'IPS'], ['tahun_ajar', $angkatan_baru->angkatan] ])
    ->first();
    if ($siswa->jumlah == null) {
        $jumlah_siswa_ips = 0;
    } else {
        $jumlah_siswa_ips = $siswa->jumlah;
    }

    $siswa = DB::table('rombel')
    ->select(DB::raw('SUM(jumlah_siswa) as jumlah'))
    ->join('users', 'users.id_rombel', '=', 'rombel.id')
    ->where([ ['peminatan', 'Bahasa dan Budaya'], ['tahun_ajar', $angkatan_baru->angkatan] ])
    ->first();
    if ($siswa->jumlah == null) {
        $jumlah_siswa_bhs = 0;
    } else {
        $jumlah_siswa_bhs = $siswa->jumlah;
    }

        // Menyiapkan data untuk bar chart, rekomendasi 1 peminatan siswa
    $tahun_ajaran = [];
    $rekomendasi_siswa_ipa = [];
    $rekomendasi_siswa_ips = [];
    $rekomendasi_siswa_bhs = [];

    $data_rekomendasi = DB::table('rekomendasi_peminatan')
    ->join('users', 'users.id', '=', 'rekomendasi_peminatan.id_user')
    ->select('users.angkatan')
    ->groupBy('users.angkatan')
    ->orderBy('users.angkatan', 'ASC')
    ->get();
    foreach ($data_rekomendasi as $data) {
        $tahun_ajaran[] = $data->angkatan;
    }

    $rekomendasi_siswa = DB::table('rekomendasi_peminatan')
    ->join('users', 'users.id', '=', 'rekomendasi_peminatan.id_user')
    ->select(
        DB::raw('COUNT(rekomendasi_peminatan.rekomendasi_1) as jumlah_siswa')
        )
    ->where('rekomendasi_peminatan.rekomendasi_1', 'MIPA')
    ->groupBy('users.angkatan')
    ->orderBy('users.angkatan', 'asc')
    ->get();
    foreach ($rekomendasi_siswa as $data) {
        $rekomendasi_siswa_ipa[] = $data->jumlah_siswa;
    }

    $rekomendasi_siswa = DB::table('rekomendasi_peminatan')
    ->join('users', 'users.id', '=', 'rekomendasi_peminatan.id_user')
    ->select(
        DB::raw('COUNT(rekomendasi_peminatan.rekomendasi_1) as jumlah_siswa')
        )
    ->where('rekomendasi_peminatan.rekomendasi_1', 'IPS')
    ->groupBy('users.angkatan')
    ->orderBy('users.angkatan', 'asc')
    ->get();
    foreach ($rekomendasi_siswa as $data) {
        $rekomendasi_siswa_ips[] = $data->jumlah_siswa;
    }

    $rekomendasi_siswa = DB::table('rekomendasi_peminatan')
    ->join('users', 'users.id', '=', 'rekomendasi_peminatan.id_user')
    ->select(
        DB::raw('COUNT(rekomendasi_peminatan.rekomendasi_1) as jumlah_siswa')
        )
    ->where('rekomendasi_peminatan.rekomendasi_1', 'Bahasa dan Budaya')
    ->groupBy('users.angkatan')
    ->orderBy('users.angkatan', 'asc')
    ->get();
    foreach ($rekomendasi_siswa as $data) {
        $rekomendasi_siswa_bhs[] = $data->jumlah_siswa;
    }

    return view('tim_ppdb.dashboard', 
        compact(
            'data_tim',
            'total', 
            'jumlah_siswa_ipa', 
            'jumlah_siswa_ips', 
            'jumlah_siswa_bhs', 
            'tahun_ajaran', 
            'rekomendasi_siswa_ipa', 
            'rekomendasi_siswa_ips',
            'rekomendasi_siswa_bhs'
            )
        );
}

public function folder_siswa(){
    $data_angkatan = DB::table('users')
    ->select('angkatan')
    ->where('role', '=', 'Siswa')
    ->groupBy('angkatan')
    ->get();
    return view('admin.folder_siswa', compact('data_angkatan'));
}

public function showSiswa($angkatan){
    $data_siswa = User::where([['role', '=', 'Siswa'], ['angkatan', '=', $angkatan]])->get();
    return view('admin.daftar_siswa', compact('data_siswa', 'angkatan'));
}

public function showAdmin(){
    $data_admin = User::where('role', 'Admin')->get();
    return view('admin.daftar_admin', compact('data_admin'));
}

public function showWakaKurikulum(){
    $data_waka = User::where('role', 'Waka Kurikulum')->get();
    return view('admin.daftar_waka_kurikulum', compact('data_waka'));
}

public function showTimPPDB(){
    $data_tim = User::where('role', 'Tim PPDB')->get();
    return view('admin.daftar_tim_ppdb', compact('data_tim'));
}

public function createAdmin(){
    return view('admin.tambah_admin');
}

public function createWakaKurikulum(){
    return view('admin.tambah_waka_kurikulum');
}

public function createTimPPDB(Request $data){
    $jumlah = $data->jumlah;
    $periode = $data->periode;
    return view('admin.tambah_tim_ppdb', compact('jumlah', 'periode'));
}

public function createSiswaPrmAngkatan(Request $data, $angkatan){
    $jumlah = $data->jumlah;
    return view('admin.tambah_siswa_prm_angkatan', compact('jumlah', 'angkatan'));
}

public function createSiswa(Request $data){
    $jumlah = $data->jumlah;
    $angkatan = $data->angkatan;
    return view('admin.tambah_siswa', compact('jumlah', 'angkatan'));
}

public function storeAdmin(Request $data){
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    User::create([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'tgl_lahir'     => $date,
        'jenis_kelamin' => $data->jenis_kelamin,
        'alamat'        => $data->alamat,
        'password'      => password_hash($data->password, PASSWORD_DEFAULT),
        'role'          => 'Admin'
        ]);
    return redirect('/daftar_admin');
}

public function storeWakaKurikulum(Request $data){
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

        // random password
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $password = '';
    for ($i = 0; $i < 8; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $password .= $karakter{$pos};
    }

    User::create([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'tgl_lahir'     => $date,
        'jenis_kelamin' => $data->jenis_kelamin,
        'alamat'        => $data->alamat,
        'periode'       => $data->periode,
        'password'      => password_hash($password, PASSWORD_DEFAULT),
        'temp_password' => $password,
        'role'          => 'Waka Kurikulum',
        ]);

    return redirect('/daftar_waka_kurikulum');
}

public function storeTimPPDB(Request $data){
    for ($i=0; $i < $data->jumlah; $i++) { 
        $exploded_data = explode("-", $data->tgl_lahir[$i]);
        $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";
            // random password
        $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $password = '';
        for ($j = 0; $j < 8; $j++) {
            $pos = rand(0, strlen($karakter)-1);
            $password .= $karakter{$pos};
        }

        User::create([
            'no_induk'      => $data->no_induk[$i],
            'name'          => $data->nama[$i],
            'email'         => $data->email[$i],
            'no_telepon'    => str_replace("_", "", $data->no_hp[$i]),
            'tgl_lahir'     => $date,
            'jenis_kelamin' => $data->jenis_kelamin[$i],
            'alamat'        => $data->alamat[$i],
            'periode'       => $data->periode,
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'temp_password' => $password,
            'role'          => 'Tim PPDB',
            ]);
    }

    return redirect('/daftar_tim_ppdb');
}

public function storeSiswa(Request $data, $angkatan){
    for ($i=0; $i < $data->jumlah; $i++) { 
        if(is_null($data->tgl_lahir[$i])){
            $date = NULL;
        } else {
            $exploded_data = explode("-", $data->tgl_lahir[$i]);
            $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";
        }

        // random password
        $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $password = '';
        for ($j = 0; $j < 8; $j++) {
            $pos = rand(0, strlen($karakter)-1);
            $password .= $karakter{$pos};
        }

        User::create([
            'no_induk'      => $data->no_induk[$i],
            'name'          => $data->nama[$i],
            'asal_sekolah'  => $data->asal_sekolah[$i],
            'email'         => $data->email[$i],
            'no_telepon'    => str_replace("_", "", $data->no_hp[$i]),
            'tgl_lahir'     => $date,
            'jenis_kelamin' => $data->jenis_kelamin[$i],
            'alamat'        => $data->alamat[$i],
            'angkatan'      => $angkatan,
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'temp_password' => $password,
            'role'          => 'Siswa',
            ]);
    }

    return redirect('/folder_siswa/daftar_siswa/'.$angkatan);
}

public function editAdmin($id){
    $data_admin = User::where('id', $id)->get();
    return view('admin.edit_admin', compact('data_admin'));
}

public function editWakaKurikulum($id){
    $data_waka = User::where('id', $id)->get();
    return view('admin.edit_waka_kurikulum', compact('data_waka'));
}

public function editTimPPDB($id){
    $data_tim = User::where('id', $id)->get();
    return view('admin.edit_tim_ppdb', compact('data_tim'));
}

public function editSiswa($id){
    $angkatan_siswa = User::select('angkatan')->where('id', $id)->groupBy('angkatan')->first();
    $angkatan = $angkatan_siswa->angkatan;

    $data_siswa = User::where('id', $id)->get();
    return view('admin.edit_siswa', compact('data_siswa', 'angkatan'));
}

public function updateAdmin(Request $data){
    $dataEdit = User::where('id', $data->id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'tgl_lahir'     => $date,
        'jenis_kelamin' => $data->jenis_kelamin,
        'alamat'        => $data->alamat,
        ]);
    return redirect('/daftar_admin');
}

public function updateWakaKurikulum(Request $data){
    $dataEdit = User::where('id', $data->id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'alamat'        => $data->alamat,
        'jenis_kelamin' => $data->jenis_kelamin,
        'tgl_lahir'     => $date,
        'periode'       => $data->periode
        ]);
    return redirect('/daftar_waka_kurikulum');
}

public function updateProfilWakaKurikulum(Request $data){
    $dataEdit = User::where('id', $data->id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'alamat'        => $data->alamat,
        'jenis_kelamin' => $data->jenis_kelamin,
        'tgl_lahir'     => $date,
        'periode'       => $data->periode
        ]);
    return redirect('/dashboard-waka-kurikulum');
}

public function updateProfilTimPPDB(Request $data){
    $dataEdit = User::where('id', $data->id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'alamat'        => $data->alamat,
        'jenis_kelamin' => $data->jenis_kelamin,
        'tgl_lahir'     => $date,
        'periode'       => $data->periode
        ]);
    return redirect('/dashboard-tim-ppdb');
}

public function updateTimPPDB(Request $data){
    $dataEdit = User::where('id', $data->id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => str_replace("_", "", $data->no_hp),
        'alamat'        => $data->alamat,
        'jenis_kelamin' => $data->jenis_kelamin,
        'tgl_lahir'     => $date,
        'periode'       => $data->periode
        ]);
    return redirect('/daftar_tim_ppdb');
}

public function updateSiswa(Request $data, $angkatan){
    $dataEdit = User::where('id', $data->id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'no_induk'      => $data->no_induk,
        'name'          => $data->nama,
        'email'         => $data->email,
        'no_telepon'    => $data->no_hp,
        'alamat'        => $data->alamat,
        'jenis_kelamin' => $data->jenis_kelamin,
        'tgl_lahir'     => $date,
        'angkatan'      => $data->angkatan,
        'asal_sekolah'  => $data->asal_sekolah,
        ]);
    return redirect('/folder_siswa/daftar_siswa/'.$angkatan);
}

public function softDeleteAdmin($id){
    User::destroy($id);
    return redirect('/daftar_admin');
}

public function softDeleteWakaKurikulum($id){
    User::destroy($id);
    return redirect('/daftar_waka_kurikulum');
}

public function softDeleteTimPPDB($id){
    User::destroy($id);
    return redirect('/daftar_tim_ppdb');
}

public function softDeleteSiswa($id){
    $data_angkatan = User::select('angkatan')->where('id', $id)->first();
    $angkatan = $data_angkatan->angkatan;
    User::destroy($id);
    return redirect('/folder_siswa/daftar_siswa/'.$angkatan);
}

public function onlyTrashedAdmin(){
    $data_admin = User::onlyTrashed()->where('role', 'Admin')->get();
    return view('admin.daftar_deleted_admin', compact('data_admin'));
}

public function onlyTrashedWakaKurikulum(){
    $data_waka = User::onlyTrashed()->where('role', 'Waka Kurikulum')->get();
    return view('admin.daftar_deleted_waka_kurikulum', compact('data_waka'));
}

public function onlyTrashedTimPPDB(){
    $data_tim = User::onlyTrashed()->where('role', 'Tim PPDB')->get();
    return view('admin.daftar_deleted_tim_ppdb', compact('data_tim'));
}

public function onlyTrashedSiswa($angkatan){
    $data_siswa = User::onlyTrashed()->where([ ['role', '=', 'Siswa'], ['angkatan', '=', $angkatan] ])->get();
    return view('admin.daftar_deleted_siswa', compact('data_siswa', 'angkatan'));
}

public function onlyTrashedSiswaFolder(){
    $data_angkatan = User::onlyTrashed()->select('angkatan')->where('role', 'Siswa')->groupBy('angkatan')->get();
    return view('admin.folder_siswa_deleted', compact('data_angkatan'));
}

public function restoreAdmin($id){
    User::onlyTrashed()->where('id', $id)->restore();
    return redirect('/daftar_admin/deleted');
}

public function restoreWakaKurikulum($id){
    User::onlyTrashed()->where('id', $id)->restore();
    return redirect('/daftar_waka_kurikulum/deleted');
}

public function restoreTimPPDB($id){
    User::onlyTrashed()->where('id', $id)->restore();
    return redirect('/daftar_tim_ppdb/deleted');
}

public function restoreSiswa($id){
    User::onlyTrashed()->where('id', $id)->restore();
    $data_angkatan = User::select('angkatan')->where('id', $id)->first();
    $angkatan = $data_angkatan->angkatan;
    return redirect('/folder_siswa/daftar_siswa/deleted/'.$angkatan);
}

public function gantiPasswordAdmin(Request $data){
    $dataEdit = User::where('id', $data->id_user);

    $dataEdit->update([
     'password' => password_hash($data->password_baru, PASSWORD_DEFAULT),
     ]);
    return redirect('/dashboard-admin');
}

public function gantiPasswordWakaKurikulum(Request $data){
    $dataEdit = User::where('id', $data->id_user);

    $dataEdit->update([
     'password' => password_hash($data->password_baru, PASSWORD_DEFAULT),
     ]);
    return redirect('/dashboard-waka-kurikulum');
}

public function gantiPasswordTimPPDB(Request $data){
    $dataEdit = User::where('id', $data->id_user);

    $dataEdit->update([
     'password' => password_hash($data->password_baru, PASSWORD_DEFAULT),
     ]);
    return redirect('/dashboard-tim-ppdb');
}

public function gantiPasswordSiswa(Request $data){
    $dataEdit = User::where('id', $data->id_user);

    $dataEdit->update([
     'password' => password_hash($data->password_baru, PASSWORD_DEFAULT),
     ]);
    return redirect('/homepage');
}

public function homepageSiswa(){
        // idPengumuman
    $pengumuman_id = Pengumuman::select('id')->orderBy('id', 'desc')->first();
    if (is_null($pengumuman_id)) {
        $id_pengumuman = "kosong";
    } else {
        $id_pengumuman = $pengumuman_id->id;
    }

        // kriteria
    $kriteria_peminatan = DB::table('record_kriteria_peminatan')->select('id_kriteria_peminatan')->where('angkatan', Auth::user()->angkatan)->first();
    if ($kriteria_peminatan == null) {
        return view('siswa.pemberitahuan', compact('id_pengumuman'));
    }
    $data_kriteria = Kriteria::where('id_kriteria_peminatan', $kriteria_peminatan->id_kriteria_peminatan)->get();
    $kriteria = DB::table('kriteria')
    ->join('angket_peminatan', 'angket_peminatan.id_kriteria', '=', 'kriteria.id')
    ->where([
        ['kriteria.id_kriteria_peminatan', '=', $kriteria_peminatan->id_kriteria_peminatan],
        ['angket_peminatan.id_user', '=', Auth::user()->id]
        ])
    ->select('kriteria.id', 'kriteria.kriteria', 'angket_peminatan.nilai', 'kriteria.kategori')
    ->get();

    $data_users = User::select('id_rombel')->where('id', Auth::user()->id)->first();
    if (is_null($data_users->id_rombel)) {
        $peminatan = "Belum ditentukan";
    } else {
        $data_rombel = DB::table('rombel')->select('peminatan')->where('id', $data_users->id_rombel)->first();
        $peminatan = $data_rombel->peminatan;
    }

    return view('siswa.homepage', compact('kriteria', 'data_kriteria', 'id_pengumuman', 'peminatan'));
}

public function editProfile(Request $data, $id){
    $dataEdit = User::where('id', $id);
    $exploded_data = explode("-", $data->tgl_lahir);
    $date = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";

    $dataEdit->update([
        'email'         => $data->email,
        'no_telepon'    => $data->no_tlp,
        'alamat'        => $data->alamat,
        'jenis_kelamin' => $data->jenis_kelamin,
        'tgl_lahir'     => $date,
        'asal_sekolah'  => $data->asal_sekolah,
        ]);
    return redirect('/homepage');
}


}
