<?php
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/')->middleware(['auth', 'role']);
// Route::get('/', function () {
// 	return view('welcome');
// });

//...............................................
// Route::get('/menu_tambah_pengguna', 'PenggunaController@createMenuTambahPengguna')->middleware(['auth', 'admin']);

// ======================================================
// ------------------------ ADMIN -----------------------
// ======================================================
Route::get('/dashboard-admin', 'PenggunaController@index')->middleware(['auth', 'admin']);
Route::post('/dashboard-admin/gantiPassword', 'PenggunaController@gantiPasswordAdmin')->middleware(['auth', 'admin']);
// Kelola Admin
Route::get('/daftar_admin', 'PenggunaController@showAdmin')->middleware(['auth', 'admin']);
Route::get('/daftar_admin/tambah', 'PenggunaController@createAdmin')->middleware(['auth', 'admin']);
Route::post('/insert_admin', 'PenggunaController@storeAdmin')->middleware(['auth', 'admin']);
Route::get('/daftar_admin/edit/{id}', 'PenggunaController@editAdmin')->middleware(['auth', 'admin']);
Route::post('/update_admin', 'PenggunaController@updateAdmin')->middleware(['auth', 'admin']);
Route::get('/daftar_admin/hapus/{id}', 'PenggunaController@softDeleteAdmin')->middleware(['auth', 'admin']);
Route::get('/daftar_admin/deleted', 'PenggunaController@onlyTrashedAdmin')->middleware(['auth', 'admin']);
Route::get('/restore_admin/{id}', 'PenggunaController@restoreAdmin')->middleware(['auth', 'admin']);
// Kelola Waka Kurikulum
Route::get('/daftar_waka_kurikulum', 'PenggunaController@showWakaKurikulum')->middleware(['auth', 'admin']);
Route::get('/daftar_waka_kurikulum/tambah', 'PenggunaController@createWakaKurikulum')->middleware(['auth', 'admin']);
Route::post('/insert_waka_kurikulum', 'PenggunaController@storeWakaKurikulum')->middleware(['auth', 'admin']);
Route::get('/daftar_waka_kurikulum/edit/{id}', 'PenggunaController@editWakaKurikulum')->middleware(['auth', 'admin']);
Route::post('/update_waka_kurikulum', 'PenggunaController@updateWakaKurikulum')->middleware(['auth', 'admin']);
Route::get('/daftar_waka_kurikulum/hapus/{id}', 'PenggunaController@softDeleteWakaKurikulum')->middleware(['auth', 'admin']);
Route::get('/daftar_waka_kurikulum/deleted', 'PenggunaController@onlyTrashedWakaKurikulum')->middleware(['auth', 'admin']);
Route::get('/restore_waka_kurikulum/{id}', 'PenggunaController@restoreWakaKurikulum')->middleware(['auth', 'admin']);
// Kelola Tim PPDB
Route::get('/daftar_tim_ppdb', 'PenggunaController@showTimPPDB')->middleware(['auth', 'admin']);
Route::post('/daftar_tim_ppdb/tambah', 'PenggunaController@createTimPPDB')->middleware(['auth', 'admin']);
Route::post('/insert_tim_ppdb', 'PenggunaController@storeTimPPDB')->middleware(['auth', 'admin']);
Route::get('/daftar_tim_ppdb/edit/{id}', 'PenggunaController@editTimPPDB')->middleware(['auth', 'admin']);
Route::post('/update_tim_ppdb', 'PenggunaController@updateTimPPDB')->middleware(['auth', 'admin']);
Route::get('daftar_tim_ppdb/hapus/{id}', 'PenggunaController@softDeleteTimPPDB')->middleware(['auth', 'admin']);
Route::get('/daftar_tim_ppdb/deleted', 'PenggunaController@onlyTrashedTimPPDB')->middleware(['auth', 'admin']);
Route::get('/restore_tim_ppdb/{id}', 'PenggunaController@restoreTimPPDB')->middleware(['auth', 'admin']);
// Kelola Siswa
Route::get('/folder_siswa', 'PenggunaController@folder_siswa')->middleware(['auth', 'admin']);
Route::get('/folder_siswa/daftar_siswa/{angkatan}', 'PenggunaController@showSiswa')->middleware(['auth', 'admin']);
Route::post('/folder_siswa/daftar_siswa/tambah/{angkatan}', 'PenggunaController@createSiswaPrmAngkatan')->middleware(['auth', 'admin']);
Route::post('/folder_siswa/tambah', 'PenggunaController@createSiswa')->middleware(['auth', 'admin']);
Route::post('/insert_siswa/{angkatan}', 'PenggunaController@storeSiswa')->middleware(['auth', 'admin']);
Route::get('/folder_siswa/daftar_siswa/edit/{id}', 'PenggunaController@editSiswa')->middleware(['auth', 'admin']);
Route::post('/update_siswa/{angkatan}', 'PenggunaController@updateSiswa')->middleware(['auth', 'admin']);
Route::get('/hapus/{id}', 'PenggunaController@softDeleteSiswa')->middleware(['auth', 'admin']);
Route::get('/folder_siswa/daftar_siswa/deleted/{angkatan}', 'PenggunaController@onlyTrashedSiswa')->middleware(['auth', 'admin']);
Route::get('/folder_siswa/deleted', 'PenggunaController@onlyTrashedSiswaFolder')->middleware(['auth', 'admin']);
Route::get('/restore_siswa/{id}', 'PenggunaController@restoreSiswa')->middleware(['auth', 'admin']);

// =============================================================
// ---------------------- Waka Kurikulum -----------------------
// =============================================================
// Dashboard
Route::get('/dashboard-waka-kurikulum', 'PenggunaController@dashboardWakaKurikulum')->middleware(['auth', 'wakaKurikulum']);
Route::post('/dashboard-waka-kurikulum/updateProfil', 'PenggunaController@updateProfilWaKaKurikulum')->middleware(['auth', 'wakaKurikulum']);
Route::post('/dashboard-waka-kurikulum/gantiPassword', 'PenggunaController@gantiPasswordWakaKurikulum')->middleware(['auth', 'wakaKurikulum']);
// Kelola rombel
Route::get('/tahun_ajaran', 'RombelController@showTahunAjaran')->middleware(['auth', 'wakaKurikulum']);
Route::get('/tahun_ajaran/daftar_rombel/{tahun_ajaran}', 'RombelController@showRombelTahunAjaran')->middleware(['auth', 'wakaKurikulum']);
Route::get('/tahun_ajaran/daftar_rombel/edit/{id}', 'RombelController@editRombel')->middleware(['auth', 'wakaKurikulum']);
Route::post('/tahun_ajaran/daftar_rombel/update', 'RombelController@updateRombel')->middleware(['auth', 'wakaKurikulum']);
Route::get('/tahun_ajaran/daftar_rombel/hapus/{id}', 'RombelController@softDeletesRombel')->middleware(['auth', 'wakaKurikulum']);
Route::post('/tahun_ajaran/tambah_rombel', 'RombelController@tambahRombel')->middleware(['auth', 'wakaKurikulum']);
Route::post('/tahun_ajaran/tambah_rombel/store', 'RombelController@storeRombel')->middleware(['auth', 'wakaKurikulum']);
Route::get('/daftar_rombel_deleted', 'RombelController@onlyTrashedRombel')->middleware(['auth', 'wakaKurikulum']);
Route::get('/daftar_rombel_deleted/restore/{id}', 'RombelController@restoreRombel')->middleware(['auth', 'wakaKurikulum']);

// ===============================================
// ------------------- TIM PPDB ------------------
// ===============================================
Route::get('/dashboard-tim-ppdb', 'PenggunaController@dashboardTimPPDB')->middleware(['auth', 'timPPDB']);
Route::post('/dashboard-tim-ppdb/updateProfil', 'PenggunaController@updateProfilTimPPDB')->middleware(['auth', 'timPPDB']);
Route::post('/dashboard-tim-ppdb/gantiPassword', 'PenggunaController@gantiPasswordTimPPDB')->middleware(['auth', 'timPPDB']);
Route::get('/daftar-kriteria', 'KriteriaTimPPDBController@showKriteria')->middleware(['auth', 'timPPDB']);
Route::get('/angket_peminatan/angkatan_siswa', 'KriteriaTimPPDBController@angkatanSiswa')->middleware(['auth', 'timPPDB']);
Route::get('/angket_peminatan/angkatan_siswa/angket/{angkatan}', 'AngketPeminatanController@showAngketPeminatanSiswa')->middleware(['auth', 'timPPDB']);
Route::get('/angket_peminatan/angkatan_siswa/angket/edit/{id}', 'AngketPeminatanController@editAngketPeminatanSiswa')->middleware(['auth', 'timPPDB']);
Route::post('/angket_peminatan/angkatan_siswa/angket/edit/update/{id}', 'AngketPeminatanController@updateAngketPeminatan_TimPPDB')->middleware(['auth', 'timPPDB']);
// Kelola kriteria
Route::get('/daftar_kriteria_peminatan', 'KriteriaController@halamanKriteriaPeminatan')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria_peminatan/buat_kriteria_baru', 'KriteriaController@buatKriteriaBaru')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria_peminatan/store_kriteria_baru', 'KriteriaController@storeKriteriaBaru')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria_peminatan/daftar_kriteria/{id}', 'KriteriaController@showKriteria')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria_peminatan/hapus_daftar_kriteria/{id}', 'KriteriaController@deleteDaftarKriteria')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria_peminatan/daftar_kriteria/tambah', 'KriteriaController@storeKriteria')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria_peminatan/daftar_kriteria/ganti_status/{id}', 'KriteriaController@gantiStatus')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria_peminatan/daftar_kriteria/update/{id}', 'KriteriaController@updateKriteria')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria/kriteria/hapus/{id}', 'KriteriaController@hapusKriteria')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria/instruksi/{id}', 'KriteriaController@instruksiPenentuanBobot')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria/nilai_perbandingan_berpasangan_ipa/{id}', 'KriteriaController@tentukanNilaiPerbandinganBerpasanganIPA')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria/nilai_perbandingan_berpasangan_ips/{id}', 'KriteriaController@tentukanNilaiPerbandinganBerpasanganIPS')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria/nilai_perbandingan_berpasangan_bhs/{id}', 'KriteriaController@tentukanNilaiPerbandinganBerpasanganBHS')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria/hitung_CI_CR_ipa/{id}', 'KriteriaController@hitungCI_CR_IPA')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria/hitung_CI_CR_ips/{id}', 'KriteriaController@hitungCI_CR_IPS')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_kriteria/hitung_CI_CR_bhs/{id}', 'KriteriaController@hitungCI_CR_BHS')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria_peminatan_deleted', 'KriteriaTimPPDBController@onlyTrashedKriteriaPeminatan')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_kriteria_peminatan_deleted/restore/{id}', 'KriteriaTimPPDBController@restoreKriteriaPeminatan')->middleware(['auth', 'timPPDB']);


// Psikotest
// Route::get('/daftar_psikotest', 'PsikotestController@showDaftarPsikotest')->middleware(['auth', 'timPPDB']);
// Route::get('/daftar_psikotest/aktifkan/{id}', 'PsikotestController@aktifkanPsikotest')->middleware(['auth', 'timPPDB']);
// Route::post('/daftar_psikotest/buat_soal', 'PsikotestController@buatSoalPsikotest')->middleware(['auth', 'timPPDB']);
// Route::post('/daftar_psikotest/buat_soal/simpan', 'PsikotestController@simpanSoalPsikotest')->middleware(['auth', 'timPPDB']);
// Route::get('/daftar_psikotest/soal/{id}', 'PsikotestController@showSoalPsikotest')->middleware(['auth', 'timPPDB']);
// Route::post('/daftar_psikotest/soal/tambah/{kode}', 'PsikotestController@tambahSoalPsikotest')->middleware(['auth', 'timPPDB']);
// Route::post('/daftar_psikotest/soal/tambah/simpan', 'PsikotestController@simpanSoalPsikotestWithCode')->middleware(['auth', 'timPPDB']);

// Rombel
Route::get('/daftar_rombel', 'RombelTimPPDBController@showRombel')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_rombel/tahun_ajaran/{tahun}', 'RombelTimPPDBController@showRombelTahunAjaran')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_rombel/absensi/{id}', 'RombelTimPPDBController@showAbsensi')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_rombel/absensi/export_data/{id}', 'RombelTimPPDBController@exportDaftarSiswa')->middleware(['auth', 'timPPDB']);
Route::post('/tambah_siswa_rombel', 'RombelTimPPDBController@addSiswa')->middleware(['auth', 'timPPDB']);
// Route::get('/daftar-rombel-ipa', 'RombelTimPPDBController@showRombelIPA')->middleware(['auth', 'timPPDB']);
// Route::get('/daftar-rombel-ips', 'RombelTimPPDBController@showRombelIPS')->middleware(['auth', 'timPPDB']);
// Route::get('/daftar-rombel-bahasa', 'RombelTimPPDBController@showRombelBahasa')->middleware(['auth', 'timPPDB']);

// Pengumuman
Route::get('/daftar_pengumuman', 'PengumumanController@daftarPengumuman')->middleware(['auth', 'timPPDB']);
Route::get('/daftar_pengumuman/tambah', 'PengumumanController@createPengumuman')->middleware(['auth', 'timPPDB']);
Route::post('/daftar_pengumuman/tambah/simpan', 'PengumumanController@storePengumuman')->middleware(['auth', 'timPPDB']);

// Angket Peminatan
Route::get('/angket_peminatan/angkatan_siswa/angket/export_data/{angkatan}', 'AngketPeminatanController@exportAngketPeminatan')->middleware(['auth', 'timPPDB']);
// Rekomendasi Peminatan
Route::get('/angket_peminatan/angkatan_siswa/angket/hasilkan_rekomendasi/{angkatan}', 'AngketPeminatanController@hasilkanRekomendasi')->middleware(['auth', 'timPPDB']);
Route::get('/angket_peminatan/angkatan_siswa/daftar_rekomendasi/{angkatan}', 'AngketPeminatanController@daftarRekomendasiPeminatan')->middleware(['auth', 'timPPDB']);
Route::get('/angket_peminatan/angkatan_siswa/pilih_kriteria_peminatan/{angkatan}', 'RecordKriteriaPeminatanController@pilihKriteriaPeminatan')->middleware(['auth', 'timPPDB']);
Route::post('/angket_peminatan/angkatan_siswa/pilih_kriteria_peminatan/simpan/{angkatan}', 'RecordKriteriaPeminatanController@simpanKriteriaPeminatan')->middleware(['auth', 'timPPDB']);
Route::get('/angket_peminatan/angkatan_siswa/daftar_rekomendasi/export_ke_excel/{angkatan}', 'AngketPeminatanController@exportDataRekomendasi')->middleware(['auth', 'timPPDB']);

// =======================================================
// ------------------ HALAMAN SISWA ----------------------
// =======================================================
Route::get('/homepage', 'PenggunaController@homepageSiswa')->middleware(['auth', 'siswa']);
Route::post('/homepage/gantiPassword', 'PenggunaController@gantiPasswordSiswa')->middleware(['auth', 'siswa']);
Route::post('/profile/edit/{id}', 'PenggunaController@editProfile')->middleware(['auth', 'siswa']);
Route::post('/angket_peminatan/simpan/{id}', 'AngketPeminatanController@storeAngketPeminatan')->middleware(['auth', 'siswa']);
Route::post('/angket_peminatan/edit/{id}', 'AngketPeminatanController@updateAngketPeminatan')->middleware(['auth', 'siswa']);
Route::get('/pengumuman/detail/{id}', 'PengumumanController@detailPengumuman')->middleware(['auth', 'siswa']);
Route::get('/psikotest', 'PsikotestController@tampilkanSoalPsikotest')->middleware(['auth', 'siswa']);
Route::get('/instruksi_pengerjaan_psikotest', 'PsikotestController@showInstruksiPengerjaan')->middleware(['auth', 'siswa']);


Route::get('/barchart', 'PenggunaController@barchart')->middleware(['auth', 'admin']);

Route::get('/edit_angket_peminatan_siswa/{id}', 'KriteriaTimPPDBController@editAngketPeminatanSiswa')->middleware(['auth', 'timPPDB']);

Route::post('/update_angket_peminatan_siswa', 'KriteriaTimPPDBController@updateAngketPeminatanSiswa')->middleware(['auth', 'timPPDB']);

Route::get('/hapus_angket_peminatan_siswa/{id}', 'KriteriaTimPPDBController@softDeletesAngketPeminatanSiswa')->middleware(['auth', 'timPPDB']);

Route::get('/buat_soal', 'PsikotestController@createSoal')->middleware(['auth', 'timPPDB']);

Route::post('/buat_soal_psikotest', 'PsikotestController@createSoalPsikotest')->middleware(['auth', 'timPPDB']);



Route::post('/store_soal_psikotest', 'PsikotestController@storeSoalPsikotest')->middleware(['auth', 'timPPDB']);




Route::get('/edit_info_psikotest/{id}', 'PsikotestController@editPsikotest')->middleware(['auth', 'timPPDB']);

Route::post('/update_psiktoest', 'PsikotestController@updatePsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/hapus_psikotest/{id}', 'PsikotestController@softDeletesPsikotest')->middleware(['auth', 'timPPDB']);




Route::get('/add_siswa/{id}', 'RombelTimPPDBController@addSiswa')->middleware(['auth', 'timPPDB']);

Route::get('/delete_siswa/{id}', 'RombelTimPPDBController@deleteSiswa')->middleware(['auth', 'timPPDB']);



Route::post('/store_siswa_rombel', 'RombelTimPPDBController@storeSiswaRombel')->middleware(['auth', 'timPPDB']);


Route::get('/edit_pengumuman/{id}', 'PengumumanController@editPengumuman')->middleware(['auth', 'timPPDB']);

Route::post('/update_pengumuman', 'PengumumanController@updatePengumuman')->middleware(['auth', 'timPPDB']);

Route::get('/hapus_pengumuman/{id}', 'PengumumanController@softDeletesPengumuman')->middleware(['auth', 'timPPDB']);

Route::get('/deleted_soal_psikotest/{id}', 'PsikotestController@onlyTrashedSoalPsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/deleted_pengumuman', 'PengumumanController@onlyTrashedPengumuman')->middleware(['auth', 'timPPDB']);



Route::get('tambah_soal_psikotest/{id}', 'PsikotestController@addSoalPsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/edit_soal_psikotest/{id}', 'PsikotestController@editSoalPsikotest')->middleware(['auth', 'timPPDB']);

Route::post('/update_soal_psikotest', 'PsikotestController@updateSoalPsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/hapus_soal_psikotest/{id}', 'PsikotestController@softDeletesSoalPsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/restore_soal_psikotest/{id}', 'PsikotestController@restoreSoalPsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/restore_psikotest/{id}', 'PsikotestController@restorePsikotest')->middleware(['auth', 'timPPDB']);

Route::get('/deleted_psikotest', 'PsikotestController@onlyTrashedPsikotest')->middleware(['auth', 'timPPDB']);



Route::get('/restore_pengumuman/{id}', 'PengumumanController@restorePengumuman')->middleware(['auth', 'timPPDB']);

//siswa
Route::get('/daftar-pengumuman', 'PengumumanSiswaController@daftarPengumuman')->middleware(['auth', 'siswa']);

Route::get('/lihat-pengumuman', 'PengumumanSiswaController@tampilkanPengumuman')->middleware(['auth', 'siswa']);

Route::get('/isi-angket-peminatan/{id}', 'AngketPeminatanController@isiAngketPeminatan')->middleware(['auth', 'siswa']);

Route::post('/store-angket-peminatan', 'AngketPeminatanController@storeAngketPeminatan')->middleware(['auth', 'siswa']);

Route::get('/tampilkan-angket-peminatan/{id}', 'AngketPeminatanController@showAngketPeminatan')->middleware(['auth', 'siswa']);

Route::get('/edit-angket-peminatan/{id}', 'AngketPeminatanController@editAngketPeminatan')->middleware(['auth', 'siswa']);

Route::post('/update-angket-peminatan', 'AngketPeminatanController@updateAngketPeminatan')->middleware(['auth', 'siswa']);

Route::get('/rekomendasi-peminatan/{id}', 'AngketPeminatanController@rekomendasiPeminatan')->middleware(['auth', 'siswa']);

Route::get('/start-psikotest', 'PsikotestController@startPsikotest')->middleware(['auth', 'siswa']);

Route::post('/store-jawaban-soal', 'PsikotestController@storeJawabanSoal')->middleware(['auth', 'siswa']);

//.......................................................................

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'role']);