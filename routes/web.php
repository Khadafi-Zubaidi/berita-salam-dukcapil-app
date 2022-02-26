<?php

use App\Http\Controllers\AdminAppController;
use App\Http\Controllers\AdminDataController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\OperatorDesaKelurahanController;
use App\Http\Controllers\RedakturController;
use App\Http\Controllers\ReporterController;

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//Beranda
Route::get('/',[BerandaController::class,'index']);
Route::get('/beritas3/{id}',[BerandaController::class,'get_id_berita_by_beranda3']);
Route::get('tampil_visi_misi',[BerandaController::class,'tampil_visi_misi'])->name('tampil_visi_misi');
Route::get('tampil_arsip_berita',[BerandaController::class,'tampil_arsip_berita'])->name('tampil_arsip_berita');
Route::get('/produklayanans3/{id}',[BerandaController::class,'get_id_produk_layanan_by_beranda3']);
Route::get('tampil_arsip_produk_layanan',[BerandaController::class,'tampil_arsip_produk_layanan'])->name('tampil_arsip_produk_layanan');
Route::get('tampil_arsip_inovasi',[BerandaController::class,'tampil_arsip_inovasi'])->name('tampil_arsip_inovasi');
Route::get('tampil_kolom_aduan',[BerandaController::class,'tampil_kolom_aduan'])->name('tampil_kolom_aduan');
Route::post('simpan_data_baru_aduan',[BerandaController::class,'simpan_data_baru_aduan'])->name('simpan_data_baru_aduan');
Route::get('tampil_terima_kasih',[BerandaController::class,'tampil_terima_kasih'])->name('tampil_terima_kasih');
Route::get('tampil_arsip_jdih',[BerandaController::class,'tampil_arsip_jdih'])->name('tampil_arsip_jdih');
Route::get('tampil_arsip_sop',[BerandaController::class,'tampil_arsip_sop'])->name('tampil_arsip_sop');
Route::get('tampil_arsip_formulir',[BerandaController::class,'tampil_arsip_formulir'])->name('tampil_arsip_formulir');
Route::get('tampil_struktur_organisasi',[BerandaController::class,'tampil_struktur_organisasi'])->name('tampil_struktur_organisasi');
Route::get('tampil_arsip_tupoksi',[BerandaController::class,'tampil_arsip_tupoksi'])->name('tampil_arsip_tupoksi');






//Admin App
Route::get('register_admin_app',[AdminAppController::class,'register_admin_app'])->name('register_admin_app');
Route::post('simpan_data_baru_admin_app',[AdminAppController::class,'simpan_data_baru_admin_app'])->name('simpan_data_baru_admin_app');
Route::get('login_admin_app',[AdminAppController::class,'login_admin_app'])->middleware('AdminAppLoggedIn');
Route::post('cek_login_admin_app',[AdminAppController::class,'cek_login_admin_app'])->name('cek_login_admin_app');
Route::get('dashboard_admin_app',[AdminAppController::class,'dashboard_admin_app'])->name('dashboard_admin_app');
Route::post('simpan_perubahan_data_profil_admin_app',[AdminAppController::class,'simpan_perubahan_data_profil_admin_app'])->name('simpan_perubahan_data_profil_admin_app');
Route::post('simpan_perubahan_data_password_admin_app',[AdminAppController::class,'simpan_perubahan_data_password_admin_app'])->name('simpan_perubahan_data_password_admin_app');
Route::post('simpan_perubahan_data_foto_admin_app',[AdminAppController::class,'simpan_perubahan_data_foto_admin_app'])->name('simpan_perubahan_data_foto_admin_app');
Route::get('logout_admin_app',[AdminAppController::class,'logout_admin_app'])->name('logout_admin_app');
Route::get('tampil_data_redaktur_oleh_admin_app',[AdminAppController::class,'tampil_data_redaktur_oleh_admin_app'])->name('tampil_data_redaktur_oleh_admin_app');
Route::get('/redakturs1/{id}',[AdminAppController::class,'get_id_redaktur_by_admin_app']);
Route::put('/redaktur',[AdminAppController::class,'simpan_perubahan_data_redaktur_oleh_admin_app'])->name('redaktur.updatedata');
Route::get('tambah_data_redaktur_oleh_admin_app',[AdminAppController::class,'tambah_data_redaktur_oleh_admin_app'])->name('tambah_data_redaktur_oleh_admin_app');
Route::post('simpan_data_baru_redaktur_oleh_admin_app',[AdminAppController::class,'simpan_data_baru_redaktur_oleh_admin_app'])->name('simpan_data_baru_redaktur_oleh_admin_app');
Route::put('/redaktur2',[AdminAppController::class,'simpan_perubahan_data_password_redaktur_oleh_admin_app'])->name('redaktur.updatedatapassword');
Route::get('tampil_data_admin_data_oleh_admin_app',[AdminAppController::class,'tampil_data_admin_data_oleh_admin_app'])->name('tampil_data_admin_data_oleh_admin_app');
Route::get('/admindatas/{id}',[AdminAppController::class,'get_id_admin_data_by_admin_app']);
Route::put('/admindata1',[AdminAppController::class,'simpan_perubahan_data_admin_data_oleh_admin_app'])->name('admindata.updatedata');
Route::put('/admindata2',[AdminAppController::class,'simpan_perubahan_data_password_admin_data_oleh_admin_app'])->name('admindata.updatedatapassword');
Route::get('tambah_data_admin_data_oleh_admin_app',[AdminAppController::class,'tambah_data_admin_data_oleh_admin_app'])->name('tambah_data_admin_data_oleh_admin_app');
Route::post('simpan_data_baru_admin_data_oleh_admin_app',[AdminAppController::class,'simpan_data_baru_admin_data_oleh_admin_app'])->name('simpan_data_baru_admin_data_oleh_admin_app');

//Admin Data
Route::get('login_admin_data',[AdminDataController::class,'login_admin_data'])->middleware('AdminDataLoggedIn');
Route::post('cek_login_admin_data',[AdminDataController::class,'cek_login_admin_data'])->name('cek_login_admin_data');
Route::get('dashboard_admin_data',[AdminDataController::class,'dashboard_admin_data'])->name('dashboard_admin_data');
Route::post('simpan_perubahan_data_profil_admin_data',[AdminDataController::class,'simpan_perubahan_data_profil_admin_data'])->name('simpan_perubahan_data_profil_admin_data');
Route::post('simpan_perubahan_data_password_admin_data',[AdminDataController::class,'simpan_perubahan_data_password_admin_data'])->name('simpan_perubahan_data_password_admin_data');
Route::post('simpan_perubahan_data_foto_admin_data',[AdminDataController::class,'simpan_perubahan_data_foto_admin_data'])->name('simpan_perubahan_data_foto_admin_data');
Route::get('logout_admin_data',[AdminDataController::class,'logout_admin_data'])->name('logout_admin_data');

Route::get('tampil_data_kecamatan_oleh_admin_data',[AdminDataController::class,'tampil_data_kecamatan_oleh_admin_data'])->name('tampil_data_kecamatan_oleh_admin_data');
Route::get('/kecamatans/{id}',[AdminDataController::class,'get_id_kecamatan_by_admin_data']);
Route::put('/kecamatan1',[AdminDataController::class,'simpan_perubahan_data_kecamatan_oleh_admin_data'])->name('kecamatan.updatedata');
Route::get('tambah_data_kecamatan_oleh_admin_data',[AdminDataController::class,'tambah_data_kecamatan_oleh_admin_data'])->name('tambah_data_kecamatan_oleh_admin_data');
Route::post('simpan_data_baru_kecamatan_oleh_admin_data',[AdminDataController::class,'simpan_data_baru_kecamatan_oleh_admin_data'])->name('simpan_data_baru_kecamatan_oleh_admin_data');

Route::get('tampil_data_desa_kelurahan_oleh_admin_data',[AdminDataController::class,'tampil_data_desa_kelurahan_oleh_admin_data'])->name('tampil_data_desa_kelurahan_oleh_admin_data');
Route::get('/desa_kelurahans/{id}',[AdminDataController::class,'get_id_desa_kelurahan_by_admin_data']);
Route::put('/desa_kelurahan1',[AdminDataController::class,'simpan_perubahan_data_desa_kelurahan_oleh_admin_data'])->name('desakelurahan.updatedata');
Route::get('tambah_data_desa_kelurahan_oleh_admin_data',[AdminDataController::class,'tambah_data_desa_kelurahan_oleh_admin_data'])->name('tambah_data_desa_kelurahan_oleh_admin_data');
Route::post('simpan_data_baru_desa_kelurahan_oleh_admin_data',[AdminDataController::class,'simpan_data_baru_desa_kelurahan_oleh_admin_data'])->name('simpan_data_baru_desa_kelurahan_oleh_admin_data');

Route::get('tampil_data_operator_desa_kelurahan_oleh_admin_data',[AdminDataController::class,'tampil_data_operator_desa_kelurahan_oleh_admin_data'])->name('tampil_data_operator_desa_kelurahan_oleh_admin_data');
Route::get('/operator_desa_kelurahans/{id}',[AdminDataController::class,'get_id_operator_desa_kelurahan_by_admin_data']);
Route::put('/operator_desa_kelurahan1',[AdminDataController::class,'simpan_perubahan_data_operator_desa_kelurahan_oleh_admin_data'])->name('operator_desa_kelurahan.updatedata');
Route::get('tambah_data_operator_desa_kelurahan_oleh_admin_data',[AdminDataController::class,'tambah_data_operator_desa_kelurahan_oleh_admin_data'])->name('tambah_data_operator_desa_kelurahan_oleh_admin_data');
Route::post('simpan_data_baru_operator_desa_kelurahan_oleh_admin_data',[AdminDataController::class,'simpan_data_baru_operator_desa_kelurahan_oleh_admin_data'])->name('simpan_data_baru_operator_desa_kelurahan_oleh_admin_data');
Route::put('/operator_desa_kelurahan2',[AdminDataController::class,'hapus_data_operator_desa_kelurahan'])->name('operator_desa_kelurahan.hapus_data');
Route::put('/operator_desa_kelurahan3',[AdminDataController::class,'simpan_perubahan_data_password_operator_desa_kelurahan_oleh_admin_data'])->name('operator_desa_kelurahan.update_password');

Route::get('tampil_data_berkas_permohonan_belum_selesai_oleh_admin_data',[AdminDataController::class,'tampil_data_berkas_permohonan_belum_selesai_oleh_admin_data'])->name('tampil_data_berkas_permohonan_belum_selesai_oleh_admin_data');
Route::get('/berkas_pengurusans/{id}',[AdminDataController::class,'get_id_berkas_pengurusan_by_admin_data']);
Route::post('/berkas_pengurusan1',[AdminDataController::class,'unggah_berkas_permohonan_selesai'])->name('berkas_permohonan.upload_berkas_permohonan_selesai');
Route::get('tampil_data_berkas_permohonan_sudah_selesai_oleh_admin_data',[AdminDataController::class,'tampil_data_berkas_permohonan_sudah_selesai_oleh_admin_data'])->name('tampil_data_berkas_permohonan_sudah_selesai_oleh_admin_data');
Route::put('/berkas_pengurusan3',[AdminDataController::class,'hapus_berkas_permohonan_oleh_admin_data'])->name('berkas_permohonan.hapus_berkas');
Route::put('/berkas_pengurusan4',[AdminDataController::class,'simpan_perubahan_data_catatan_penting_oleh_admin_data'])->name('berkas_pengurusan.isi_canting');

//Redaktur
Route::get('login_redaktur',[RedakturController::class,'login_redaktur'])->middleware('RedakturLoggedIn');
Route::post('cek_login_redaktur',[RedakturController::class,'cek_login_redaktur'])->name('cek_login_redaktur');
Route::get('dashboard_redaktur',[RedakturController::class,'dashboard_redaktur'])->name('dashboard_redaktur');
Route::post('simpan_perubahan_data_profil_redaktur',[RedakturController::class,'simpan_perubahan_data_profil_redaktur'])->name('simpan_perubahan_data_profil_redaktur');
Route::post('simpan_perubahan_data_password_redaktur',[RedakturController::class,'simpan_perubahan_data_password_redaktur'])->name('simpan_perubahan_data_password_redaktur');
Route::post('simpan_perubahan_data_foto_redaktur',[RedakturController::class,'simpan_perubahan_data_foto_redaktur'])->name('simpan_perubahan_data_foto_redaktur');
Route::get('logout_redaktur',[RedakturController::class,'logout_redaktur'])->name('logout_redaktur');
Route::get('tampil_data_reporter_oleh_redaktur',[RedakturController::class,'tampil_data_reporter_oleh_redaktur'])->name('tampil_data_reporter_oleh_redaktur');
Route::get('/reporters1/{id}',[RedakturController::class,'get_id_reporter_by_redaktur']);
Route::put('/reporter',[RedakturController::class,'simpan_perubahan_data_reporter_oleh_redaktur'])->name('reporter.updatedata');
Route::put('/reporter2',[RedakturController::class,'simpan_perubahan_data_password_reporter_oleh_redaktur'])->name('reporter.updatedatapasswordolehredaktur');

Route::get('tambah_data_reporter_oleh_redaktur',[RedakturController::class,'tambah_data_reporter_oleh_redaktur'])->name('tambah_data_reporter_oleh_redaktur');
Route::post('simpan_data_baru_reporter_oleh_redaktur',[RedakturController::class,'simpan_data_baru_reporter_oleh_redaktur'])->name('simpan_data_baru_reporter_oleh_redaktur');
Route::get('tampil_data_reporter_oleh_redaktur',[RedakturController::class,'tampil_data_reporter_oleh_redaktur'])->name('tampil_data_reporter_oleh_redaktur');
Route::get('/carousels1/{id}',[RedakturController::class,'get_id_carousel_by_redaktur1']);
Route::put('/carousel1',[RedakturController::class,'simpan_perubahan_data_carousel_oleh_redaktur'])->name('carousel.updatedata');
Route::get('/carousels2/{id}',[RedakturController::class,'get_id_carousel_by_redaktur2']);
Route::post('/carousel2',[RedakturController::class,'updateDataFotoCarousel'])->name('carousels.updatedatafoto');
Route::get('tampil_data_carousel_oleh_redaktur',[RedakturController::class,'tampil_data_carousel_oleh_redaktur'])->name('tampil_data_carousel_oleh_redaktur');
Route::get('tambah_data_carousel_oleh_redaktur',[RedakturController::class,'tambah_data_carousel_oleh_redaktur'])->name('tambah_data_carousel_oleh_redaktur');
Route::post('simpan_data_baru_carousel_oleh_redaktur',[RedakturController::class,'simpan_data_baru_carousel_oleh_redaktur'])->name('simpan_data_baru_carousel_oleh_redaktur');
Route::get('/carousels6/{id}',[RedakturController::class,'get_id_carousel_by_redaktur6']);
Route::put('/carousel6',[RedakturController::class,'deleteData'])->name('carousel.deletedata');

Route::get('tampil_data_aduan_oleh_redaktur',[RedakturController::class,'tampil_data_aduan_oleh_redaktur'])->name('tampil_data_aduan_oleh_redaktur');
Route::get('/aduans1/{id}',[RedakturController::class,'get_id_aduan_by_redaktur']);
Route::put('/aduan1',[RedakturController::class,'simpan_perubahan_data_aduan_oleh_redaktur'])->name('aduan.updatedata');

Route::get('tampil_data_video_oleh_redaktur',[RedakturController::class,'tampil_data_video_oleh_redaktur'])->name('tampil_data_video_oleh_redaktur');
Route::get('/videos1/{id}',[RedakturController::class,'get_id_video_by_redaktur']);
Route::put('/video1',[RedakturController::class,'simpan_perubahan_data_video_oleh_redaktur'])->name('video.updatedata');





Route::get('tampil_data_berita_oleh_redaktur',[RedakturController::class,'tampil_data_berita_oleh_redaktur'])->name('tampil_data_berita_oleh_redaktur');
Route::get('/beritas4/{id}',[RedakturController::class,'get_id_berita_by_redaktur1']);
Route::put('/berita4',[RedakturController::class,'simpan_perubahan_data_berita_oleh_redaktur'])->name('berita.updatedata2');


Route::get('/beritas5/{id}',[RedakturController::class,'get_id_berita_by_redaktur2']);
Route::put('/berita5',[RedakturController::class,'updateDataFotoBerita'])->name('berita5.updatedatafoto');

Route::get('tampil_data_sambutan_dinas_oleh_redaktur',[RedakturController::class,'tampil_data_sambutan_dinas_oleh_redaktur'])->name('tampil_data_sambutan_dinas_oleh_redaktur');
Route::get('/sambutandinas1/{id}',[RedakturController::class,'get_id_sambutan_dinas_by_redaktur1']);
Route::put('/sambutandinas1',[RedakturController::class,'simpan_perubahan_data_sambutan_dinas_oleh_redaktur'])->name('sambutandinas.updatedata1');
Route::get('/sambutandinas2/{id}',[RedakturController::class,'get_id_sambutan_dinas_by_redaktur2']);
Route::post('/sambutandinas2',[RedakturController::class,'updateDataFotoSambutan'])->name('sambutan_dinas.updatedatafoto');

Route::get('/reporters6/{id}',[RedakturController::class,'get_id_reporter_by_redaktur6']);
Route::put('/reporter6',[RedakturController::class,'deleteDataReporter'])->name('reporter.deletedata');

Route::get('tampil_data_produk_layanan_oleh_redaktur',[RedakturController::class,'tampil_data_produk_layanan_oleh_redaktur'])->name('tampil_data_produk_layanan_oleh_redaktur');
Route::get('/produklayanans1/{id}',[RedakturController::class,'get_id_produk_layanan_by_redaktur1']);
Route::put('/produklayanan1',[RedakturController::class,'simpan_perubahan_data_produk_layanan_oleh_redaktur'])->name('produklayanan1.updatedata');
Route::post('/produklayanan4',[RedakturController::class,'updateDataFotoProdukLayanan'])->name('produklayanan.updatedatafoto');
Route::get('/produklayanans6/{id}',[RedakturController::class,'get_id_produk_layanan_by_redaktur6']);
Route::put('/produklayanans6',[RedakturController::class,'deleteDataProdukLayanan'])->name('produklayanan6.deletedata');
Route::get('tambah_data_produk_layanan_oleh_redaktur',[RedakturController::class,'tambah_data_produk_layanan_oleh_redaktur'])->name('tambah_data_produk_layanan_oleh_redaktur');
Route::post('simpan_data_baru_produk_layanan_oleh_redaktur',[RedakturController::class,'simpan_data_baru_produk_layanan_oleh_redaktur'])->name('simpan_data_baru_produk_layanan_oleh_redaktur');

Route::get('tampil_data_inovasi_oleh_redaktur',[RedakturController::class,'tampil_data_inovasi_oleh_redaktur'])->name('tampil_data_inovasi_oleh_redaktur');
Route::get('/inovasis1/{id}',[RedakturController::class,'get_id_inovasi_by_redaktur']);
Route::put('/inovasi1',[RedakturController::class,'simpan_perubahan_data_inovasi_oleh_redaktur'])->name('inovasi.updatedata');
Route::post('/inovasi2',[RedakturController::class,'simpan_perubahan_data_foto_inovasi_oleh_redaktur'])->name('inovasi.updatedatafoto');
Route::put('/inovasi3',[RedakturController::class,'hapus_data_inovasi_oleh_redaktur'])->name('inovasi.deletedata');
Route::get('tambah_data_inovasi_oleh_redaktur',[RedakturController::class,'tambah_data_inovasi_oleh_redaktur'])->name('tambah_data_inovasi_oleh_redaktur');
Route::post('simpan_data_baru_inovasi_oleh_redaktur',[RedakturController::class,'simpan_data_baru_inovasi_oleh_redaktur'])->name('simpan_data_baru_inovasi_oleh_redaktur');

Route::get('tampil_data_jdih_oleh_redaktur',[RedakturController::class,'tampil_data_jdih_oleh_redaktur'])->name('tampil_data_jdih_oleh_redaktur');
Route::get('/jdihs/{id}',[RedakturController::class,'get_id_jdih_by_redaktur']);
Route::put('/jdih1',[RedakturController::class,'simpan_perubahan_data_jdih_oleh_redaktur'])->name('jdih.updatedata');
Route::get('tambah_data_jdih_oleh_redaktur',[RedakturController::class,'tambah_data_jdih_oleh_redaktur'])->name('tambah_data_jdih_oleh_redaktur');
Route::post('simpan_data_baru_jdih_oleh_redaktur',[RedakturController::class,'simpan_data_baru_jdih_oleh_redaktur'])->name('simpan_data_baru_jdih_oleh_redaktur');
Route::post('/jdih4',[RedakturController::class,'simpan_perubahan_file_jdih_oleh_redaktur'])->name('jdih.updatefile');
Route::put('/jdih6',[RedakturController::class,'hapus_data_jdih_oleh_redaktur'])->name('jdih.deletedata');

Route::get('tampil_data_sop_oleh_redaktur',[RedakturController::class,'tampil_data_sop_oleh_redaktur'])->name('tampil_data_sop_oleh_redaktur');
Route::get('/sops/{id}',[RedakturController::class,'get_id_sop_by_redaktur']);
Route::put('/sop1',[RedakturController::class,'simpan_perubahan_data_sop_oleh_redaktur'])->name('sop.updatedata');
Route::get('tambah_data_sop_oleh_redaktur',[RedakturController::class,'tambah_data_sop_oleh_redaktur'])->name('tambah_data_sop_oleh_redaktur');
Route::post('simpan_data_baru_sop_oleh_redaktur',[RedakturController::class,'simpan_data_baru_sop_oleh_redaktur'])->name('simpan_data_baru_sop_oleh_redaktur');
Route::post('/sop4',[RedakturController::class,'simpan_perubahan_file_sop_oleh_redaktur'])->name('sop.updatefile');
Route::put('/sop6',[RedakturController::class,'hapus_data_sop_oleh_redaktur'])->name('sop.deletedata');

Route::get('tampil_data_formulir_oleh_redaktur',[RedakturController::class,'tampil_data_formulir_oleh_redaktur'])->name('tampil_data_formulir_oleh_redaktur');
Route::get('/formulirs/{id}',[RedakturController::class,'get_id_formulir_by_redaktur']);
Route::put('/formulir1',[RedakturController::class,'simpan_perubahan_data_formulir_oleh_redaktur'])->name('formulir.updatedata');
Route::get('tambah_data_formulir_oleh_redaktur',[RedakturController::class,'tambah_data_formulir_oleh_redaktur'])->name('tambah_data_formulir_oleh_redaktur');
Route::post('simpan_data_baru_formulir_oleh_redaktur',[RedakturController::class,'simpan_data_baru_formulir_oleh_redaktur'])->name('simpan_data_baru_formulir_oleh_redaktur');
Route::post('/formulir4',[RedakturController::class,'simpan_perubahan_file_formulir_oleh_redaktur'])->name('formulir.updatefile');
Route::put('/formulir6',[RedakturController::class,'hapus_data_formulir_oleh_redaktur'])->name('formulir.deletedata');

Route::get('tampil_data_struktur_organisasi_oleh_redaktur',[RedakturController::class,'tampil_data_struktur_organisasi_oleh_redaktur'])->name('tampil_data_struktur_organisasi_oleh_redaktur');
Route::get('/strukturorganisasis/{id}',[RedakturController::class,'get_id_struktur_organisasi_by_redaktur']);
Route::post('/strukturorganisasi',[RedakturController::class,'simpan_perubahan_data_foto_struktur_organisasi_oleh_redaktur'])->name('strukturorganisasi.updatedatafoto');

Route::get('tampil_data_tupoksi_oleh_redaktur',[RedakturController::class,'tampil_data_tupoksi_oleh_redaktur'])->name('tampil_data_tupoksi_oleh_redaktur');
Route::get('/tupoksis/{id}',[RedakturController::class,'get_id_tupoksi_by_redaktur']);
Route::put('/tupoksi1',[RedakturController::class,'simpan_perubahan_data_tupoksi_oleh_redaktur'])->name('tupoksi.updatedata');
Route::post('/tupoksi2',[RedakturController::class,'simpan_perubahan_file_tupoksi_oleh_redaktur'])->name('tupoksi.updatefile');










//Reporter
Route::get('login_reporter',[ReporterController::class,'login_reporter'])->middleware('ReporterLoggedIn');
Route::post('cek_login_reporter',[ReporterController::class,'cek_login_reporter'])->name('cek_login_reporter');
Route::get('dashboard_reporter',[ReporterController::class,'dashboard_reporter'])->name('dashboard_reporter');
Route::post('simpan_perubahan_data_profil_reporter',[ReporterController::class,'simpan_perubahan_data_profil_reporter'])->name('simpan_perubahan_data_profil_reporter');
Route::post('simpan_perubahan_data_password_reporter',[ReporterController::class,'simpan_perubahan_data_password_reporter'])->name('simpan_perubahan_data_password_reporter');
Route::post('simpan_perubahan_data_foto_reporter',[ReporterController::class,'simpan_perubahan_data_foto_reporter'])->name('simpan_perubahan_data_foto_reporter');
Route::get('logout_reporter',[ReporterController::class,'logout_reporter'])->name('logout_reporter');
Route::get('tampil_data_berita_oleh_reporter',[ReporterController::class,'tampil_data_berita_oleh_reporter'])->name('tampil_data_berita_oleh_reporter');

Route::get('/beritas1/{id}',[ReporterController::class,'get_id_berita_by_reporter1']);
Route::put('/berita1',[ReporterController::class,'simpan_perubahan_data_berita_oleh_reporter'])->name('berita.updatedata');

Route::get('/beritas2/{id}',[ReporterController::class,'get_id_berita_by_reporter2']);
Route::post('/berita2',[ReporterController::class,'updateDataFotoBerita'])->name('berita.updatedatafoto');

Route::get('tambah_data_berita_oleh_reporter',[ReporterController::class,'tambah_data_berita_oleh_reporter'])->name('tambah_data_berita_oleh_reporter');
Route::post('simpan_data_baru_berita_oleh_reporter',[ReporterController::class,'simpan_data_baru_berita_oleh_reporter'])->name('simpan_data_baru_berita_oleh_reporter');

Route::get('/beritas6/{id}',[ReporterController::class,'get_id_berita_by_reporter6']);
Route::put('/berita6',[ReporterController::class,'deleteData'])->name('berita.deletedata');

//Operator
Route::get('login_operator',[OperatorDesaKelurahanController::class,'login_operator'])->middleware('OperatorLoggedIn');
Route::post('cek_login_operator',[OperatorDesaKelurahanController::class,'cek_login_operator'])->name('cek_login_operator');
Route::get('dashboard_operator',[OperatorDesaKelurahanController::class,'dashboard_operator'])->name('dashboard_operator');
Route::post('simpan_perubahan_data_profil_operator',[OperatorDesaKelurahanController::class,'simpan_perubahan_data_profil_operator'])->name('simpan_perubahan_data_profil_operator');
Route::post('simpan_perubahan_data_password_operator',[OperatorDesaKelurahanController::class,'simpan_perubahan_data_password_operator'])->name('simpan_perubahan_data_password_operator');
Route::post('simpan_perubahan_data_foto_operator',[OperatorDesaKelurahanController::class,'simpan_perubahan_data_foto_operator'])->name('simpan_perubahan_data_foto_operator');
Route::get('logout_operator',[OperatorDesaKelurahanController::class,'logout_operator'])->name('logout_operator');
Route::get('tambah_data_berkas_oleh_operator',[OperatorDesaKelurahanController::class,'tambah_data_berkas_oleh_operator'])->name('tambah_data_berkas_oleh_operator');
Route::post('simpan_data_baru_permohonan_oleh_operator',[OperatorDesaKelurahanController::class,'simpan_data_baru_permohonan_oleh_operator'])->name('simpan_data_baru_permohonan_oleh_operator');
Route::get('tampil_data_berkas_permohonan_belum_selesai_oleh_operator',[OperatorDesaKelurahanController::class,'tampil_data_berkas_permohonan_belum_selesai_oleh_operator'])->name('tampil_data_berkas_permohonan_belum_selesai_oleh_operator');
Route::post('/berkas_pengurusan2',[OperatorDesaKelurahanController::class,'unggah_berkas_permohonan_lagi_oleh_operator'])->name('berkas_permohonan.upload_berkas_permohonan_lagi');
Route::get('tampil_data_berkas_permohonan_sudah_selesai_oleh_operator',[OperatorDesaKelurahanController::class,'tampil_data_berkas_permohonan_sudah_selesai_oleh_operator'])->name('tampil_data_berkas_permohonan_sudah_selesai_oleh_operator');
//cetak bukti pendaftaran menggunakan DOMPDF
Route::get('/cetak_bukti_pendaftaran_oleh_operator/{id}',[OperatorDesaKelurahanController::class,'cetak_bukti_pendaftaran_oleh_operator'])->name('cetak_bukti_pendaftaran_oleh_operator');
