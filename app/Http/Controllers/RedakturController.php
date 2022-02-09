<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Berita;
use App\Models\Carousel;
use App\Models\Inovasi;
use App\Models\Jdih;
use App\Models\ProdukLayanan;
use App\Models\Redaktur;
use App\Models\Reporter;
use App\Models\SambutanDinas;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RedakturController extends Controller
{
    public function login_redaktur(){
        return view('login.login_redaktur');
    }

    public function cek_login_redaktur(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = Redaktur::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedRedaktur',$cek_login->id);
                return redirect('dashboard_redaktur');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }

    public function dashboard_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $jumlah_reporter = DB::table('reporters')
                ->count();
            $jumlah_aduan_belum_ditanggapi = DB::table('aduans')
                ->where('tanggapan', '=', 'B')
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('dashboard.dashboard_redaktur',$data,compact('jumlah_reporter','jumlah_aduan_belum_ditanggapi'));
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_perubahan_data_profil_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $request->validate([
                'nama'=>'required',
                'jabatan'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nama.required'=>'Nama tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat dan Golongan tidak boleh kosong',
            ]);
            $admin_data = Redaktur::find($request->id);
            $admin_data->nama = $request->nama;
            $admin_data->jabatan = $request->jabatan;
            $admin_data->pangkat_golongan = $request->pangkat_golongan;
            $admin_data->save();
            return redirect('dashboard_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_perubahan_data_password_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = Redaktur::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_perubahan_data_foto_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $admin_data = Redaktur::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_redaktur'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function logout_redaktur(){
        if (session()->has('LoggedRedaktur')){
            session()->pull('LoggedRedaktur');
            return redirect('login_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function tampil_data_reporter_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Reporter::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_reporter_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_reporter_by_redaktur($id){
        $data = Reporter::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_reporter_oleh_redaktur(Request $request){
        $data_perubahan = Reporter::find($request->id);
        $data_perubahan->nip = $request->nip;
        $data_perubahan->nama = $request->nama;
        $data_perubahan->jabatan = $request->jabatan;
        $data_perubahan->pangkat_golongan = $request->pangkat_golongan;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->password = Hash::make($request->password);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_reporter_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_redaktur.tambah_data_reporter_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_data_baru_reporter_oleh_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $request->validate([
                'nip'=>'required|unique:reporters',
                'nama'=>'required',
                'jabatan'=>'required',
                'password'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nip.required'=>'NIP tidak boleh kosong',
                'nip.unique'=>'NIP sudah digunakan',
                'nama.required'=>'Nama tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'password.required'=>'Password tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat Golongan tidak boleh kosong',
            ]);
            $data_baru = new Reporter();
            $data_baru->nip = $request->nip;
            $data_baru->nama = $request->nama;
            $data_baru->jabatan = $request->jabatan;
            $data_baru->pangkat_golongan = $request->pangkat_golongan;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_reporter_oleh_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function tampil_data_carousel_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Carousel::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_carousel_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_carousel_by_redaktur1($id){
        $data = Carousel::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_carousel_oleh_redaktur(Request $request){
        $data_perubahan = Carousel::find($request->id);
        $data_perubahan->judul = $request->judul;
        $data_perubahan->keterangan_singkat = $request->keterangan_singkat;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function get_id_carousel_by_redaktur2($id){
        $data = Carousel::find($id);
        return response()->json($data);
    }

    public function updateDataFotoCarousel(Request $request){
        $data_foto_diperbaharui = Carousel::find($request->id4);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('foto_carousel'),$filename);
        $data = $filename;
        $data_foto_diperbaharui->foto = $data;
        $data_foto_diperbaharui->save();
        return response()->json($data_foto_diperbaharui);
    }

    public function tambah_data_carousel_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_redaktur.tambah_data_carousel_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_data_baru_carousel_oleh_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $request->validate([
                'judul'=>'required',
                'keterangan_singkat'=>'required',
            ],[
                'judul.required'=>'Judul tidak boleh kosong',
                'keterangan_singkat.required'=>'Keterangan tidak boleh kosong',
            ]);
            $data_baru = new Carousel();
            $data_baru->judul = $request->judul;
            $data_baru->keterangan_singkat = $request->keterangan_singkat;
            $data_baru->save();
            return redirect('tampil_data_carousel_oleh_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function tampil_data_berita_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Berita::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_berita_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_berita_by_redaktur1($id){
        $data = Berita::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_berita_oleh_redaktur(Request $request){
        $data_perubahan = Berita::find($request->id);
        $data_perubahan->judul = $request->judul;
        $data_perubahan->isi_berita = $request->isi_berita;
        $data_perubahan->tanggal_berita = $request->tanggal_berita;
        $data_perubahan->diperiksa_oleh_redaktur = $request->diperiksa_oleh_redaktur;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function get_id_berita_by_redaktur2($id){
        $data = Berita::find($id);
        return response()->json($data);
    }

    public function updateDataFotoBerita(Request $request){
        $data_foto_diperbaharui = Berita::find($request->id4);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('foto_berita'),$filename);
        $data = $filename;
        $data_foto_diperbaharui->foto = $data;
        $data_foto_diperbaharui->save();
        return response()->json($data_foto_diperbaharui);
    }

    public function tampil_data_sambutan_dinas_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = SambutanDinas::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_sambutan_dinas_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_sambutan_dinas_by_redaktur1($id){
        $data = SambutanDinas::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_sambutan_dinas_oleh_redaktur(Request $request){
        $data_perubahan = SambutanDinas::find($request->id);
        $data_perubahan->isi_sambutan = $request->isi_sambutan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function get_id_sambutan_dinas_by_redaktur2($id){
        $data = SambutanDinas::find($id);
        return response()->json($data);
    }

    public function updateDataFotoSambutan(Request $request){
        $data_foto_diperbaharui = SambutanDinas::find($request->id4);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('foto_sambutan_dinas'),$filename);
        $data = $filename;
        $data_foto_diperbaharui->foto = $data;
        $data_foto_diperbaharui->save();
        return response()->json($data_foto_diperbaharui);
    }

    public function get_id_carousel_by_redaktur6($id){
        $data = Carousel::find($id);
        return response()->json($data);
    }

    public function deleteData(Request $request){
        $data_berita_dihapus = Carousel::find($request->id);
        $data_berita_dihapus->delete();
        return response()->json($data_berita_dihapus);
    }

    public function get_id_reporter_by_redaktur6($id){
        $data = Reporter::find($id);
        return response()->json($data);
    }

    public function deleteDataReporter(Request $request){
        $data_berita_dihapus = Reporter::find($request->id);
        $data_berita_dihapus->delete();
        return response()->json($data_berita_dihapus);
    }

    public function tampil_data_produk_layanan_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = ProdukLayanan::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_produk_layanan_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_produk_layanan_by_redaktur1($id){
        $data = ProdukLayanan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_produk_layanan_oleh_redaktur(Request $request){
        $data_perubahan = ProdukLayanan::find($request->id);
        $data_perubahan->nama_produk_layanan = $request->nama_produk_layanan;
        $data_perubahan->dasar_hukum = $request->dasar_hukum;
        $data_perubahan->persyaratan = $request->persyaratan;
        $data_perubahan->prosedur_mekanisme = $request->prosedur_mekanisme;
        $data_perubahan->waktu_penyelesaian = $request->waktu_penyelesaian;
        $data_perubahan->biaya_tarif = $request->biaya_tarif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function get_id_produk_layanan_by_redaktur6($id){
        $data = ProdukLayanan::find($id);
        return response()->json($data);
    }

    public function deleteDataProdukLayanan(Request $request){
        $data_berita_dihapus = ProdukLayanan::find($request->id);
        $data_berita_dihapus->delete();
        return response()->json($data_berita_dihapus);
    }

    public function tambah_data_produk_layanan_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_redaktur.tambah_data_produk_layanan_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_data_baru_produk_layanan_oleh_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $request->validate([
                'nama_produk_layanan'=>'required',
                'dasar_hukum'=>'required',
                'persyaratan'=>'required',
                'prosedur_mekanisme'=>'required',
                'waktu_penyelesaian'=>'required',
                'biaya_tarif'=>'required',
            ],[
                'nama_produk_layanan.required'=>'Nama Produk Pelayanan tidak boleh kosong',
                'dasar_hukum.required'=>'Dasar Hukum tidak boleh kosong',
                'persyaratan.required'=>'Persyaratan tidak boleh kosong',
                'prosedur_mekanisme.required'=>'Prosedur Mekanisme tidak boleh kosong',
                'waktu_penyelesaian.required'=>'Waktu Penyelesaian tidak boleh kosong',
                'biaya_tarif.required'=>'Biaya Tarif tidak boleh kosong',
            ]);
            $data_baru = new ProdukLayanan();
            $data_baru->nama_produk_layanan = $request->nama_produk_layanan;
            $data_baru->dasar_hukum = $request->dasar_hukum;
            $data_baru->persyaratan = $request->persyaratan;
            $data_baru->prosedur_mekanisme = $request->prosedur_mekanisme;
            $data_baru->waktu_penyelesaian = $request->waktu_penyelesaian;
            $data_baru->biaya_tarif = $request->biaya_tarif;
            $data_baru->save();
            return redirect('tampil_data_produk_layanan_oleh_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function tampil_data_inovasi_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Inovasi::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_inovasi_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_inovasi_by_redaktur($id){
        $data = Inovasi::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_inovasi_oleh_redaktur(Request $request){
        $data_perubahan = Inovasi::find($request->id);
        $data_perubahan->nama_inovasi = $request->nama_inovasi;
        $data_perubahan->deskripsi = $request->deskripsi;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function simpan_perubahan_data_foto_inovasi_oleh_redaktur(Request $request){
        $data_foto_diperbaharui = Inovasi::find($request->id2);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('foto_inovasi'),$filename);
        $data = $filename;
        $data_foto_diperbaharui->foto = $data;
        $data_foto_diperbaharui->save();
        return response()->json($data_foto_diperbaharui);
    }

    public function hapus_data_inovasi_oleh_redaktur(Request $request){
        $data_dihapus = Inovasi::find($request->id);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function tambah_data_inovasi_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_redaktur.tambah_data_inovasi_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_data_baru_inovasi_oleh_redaktur(Request $request){
        if (session()->has('LoggedRedaktur')){
            $request->validate([
                'nama_inovasi'=>'required',
                'deskripsi'=>'required',
            ],[
                'nama_inovasi.required'=>'Nama Inovasi tidak boleh kosong',
                'deskripsi.required'=>'Deskripsi tidak boleh kosong',
            ]);
            $data_baru = new Inovasi();
            $data_baru->nama_inovasi = $request->nama_inovasi;
            $data_baru->deskripsi = $request->deskripsi;
            $data_baru->save();
            return redirect('tampil_data_inovasi_oleh_redaktur');
        }else{
            return view('login.login_redaktur');
        }
    }

    public function tampil_data_aduan_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Aduan::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_aduan_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_aduan_by_redaktur($id){
        $data = Aduan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_aduan_oleh_redaktur(Request $request){
        $data_perubahan = Aduan::find($request->id);
        $data_perubahan->tanggapan = $request->tanggapan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tampil_data_video_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Video::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_video_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
        
    }

    public function get_id_video_by_redaktur($id){
        $data = Video::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_video_oleh_redaktur(Request $request){
        $data_perubahan = Video::find($request->id);
        $data_perubahan->link = $request->link;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function updateDataFotoProdukLayanan(Request $request){
        $data_foto_diperbaharui = ProdukLayanan::find($request->id4);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('foto_produk_layanan'),$filename);
        $data = $filename;
        $data_foto_diperbaharui->foto = $data;
        $data_foto_diperbaharui->save();
        return response()->json($data_foto_diperbaharui);
    }

    public function tampil_data_jdih_oleh_redaktur(){
        if (session()->has('LoggedRedaktur')){
            $data_admin_untuk_dashboard = Redaktur::where('id','=',session('LoggedRedaktur'))->first();
            $data_tabel = Jdih::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_redaktur.tampil_data_jdih_oleh_redaktur',$data);
        }else{
            return view('login.login_redaktur');
        }
    }

    public function get_id_jdih_by_redaktur($id){
        $data = Jdih::find($id);
        return response()->json($data);
    }




}
