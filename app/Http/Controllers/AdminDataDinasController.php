<?php

namespace App\Http\Controllers;

use App\Models\AdminApp;
use App\Models\AdminDataDinas;
use App\Models\BerkasPengurusan;
use App\Models\BerkasPermohonanDariFaskes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDataDinasController extends Controller
{
    
    public function tampil_data_admin_data_dinas_oleh_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $data_tabel = AdminDataDinas::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_app.tampil_data_admin_data_dinas_oleh_admin_app',$data);
        }else{
            return view('login.login_admin_app');
        }   
    }

    public function get_id_admin_data_dinas_by_admin_app($id){
        $data = AdminDataDinas::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_admin_data_dinas_oleh_admin_app(Request $request){
        $data_perubahan = AdminDataDinas::find($request->id);
        $data_perubahan->nip = $request->nip;
        $data_perubahan->nama = $request->nama;
        $data_perubahan->jabatan = $request->jabatan;
        $data_perubahan->pangkat_golongan = $request->pangkat_golongan;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function simpan_perubahan_data_password_admin_data_dinas_oleh_admin_app(Request $request){
        $data_perubahan = AdminDataDinas::find($request->id);
        $data_perubahan->password = Hash::make($request->password);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }
    
    public function tambah_data_admin_data_dinas_oleh_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_admin_app.tambah_data_admin_data_dinas_oleh_admin_app',$data);
        }else{
            return view('login.login_admin_app');
        }
    }

    public function simpan_data_baru_admin_data_dinas_oleh_admin_app(Request $request){
        if (session()->has('LoggedAdminApp')){
            $request->validate([
                'nip'=>'required|unique:admin_data_dinas',
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
            $data_baru = new AdminDataDinas();
            $data_baru->nip = $request->nip;
            $data_baru->nama = $request->nama;
            $data_baru->jabatan = $request->jabatan;
            $data_baru->pangkat_golongan = $request->pangkat_golongan;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_admin_data_dinas_oleh_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    public function login_admin_data_dinas(){
        return view('login.login_admin_data_dinas');
    }

    public function cek_login_admin_data_dinas(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = AdminDataDinas::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedAdminDataDinas',$cek_login->id);
                return redirect('dashboard_admin_data_dinas');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }

    public function dashboard_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $jumlah_kecamatan = DB::table('kecamatans')
                ->count();
            $jumlah_desa_kelurahan = DB::table('desa_kelurahans')
                ->count();
            $jumlah_operator_desa_kelurahan = DB::table('operator_desa_kelurahans')
                ->count();
            $jumlah_fasilitas_kesehatan = DB::table('fasilitas_kesehatans')
                ->count();
            $jumlah_operator_fasilitas_kesehatan = DB::table('operator_fasilitas_kesehatans')
                ->count();
            $jumlah_kua = DB::table('kuas')
                ->count();
            $jumlah_operator_kua = DB::table('operator_kuas')
                ->count();
            $jumlah_berkas_pengurusan_yang_belum_selesai = DB::table('berkas_pengurusans')
                ->where('status','=','B')
                ->count();
            $jumlah_berkas_pengurusan_yang_sudah_selesai = DB::table('berkas_pengurusans')
                ->where('status','=','S')
                ->count();
            $jumlah_berkas_permohonan_dari_faskes_yang_belum_selesai = DB::table('berkas_permohonan_dari_faskes')
                ->where('status','=','B')
                ->count();
            $jumlah_berkas_permohonan_dari_faskes_yang_sudah_selesai = DB::table('berkas_permohonan_dari_faskes')
                ->where('status','=','S')
                ->count();
            $jumlah_berkas_permohonan_dari_kua_yang_belum_selesai = DB::table('berkas_permohonan_dari_kuas')
                ->where('status','=','B')
                ->count();
            $jumlah_berkas_permohonan_dari_kua_yang_sudah_selesai = DB::table('berkas_permohonan_dari_kuas')
                ->where('status','=','S')
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('dashboard.dashboard_admin_data_dinas',$data,compact('jumlah_kecamatan','jumlah_desa_kelurahan',
            'jumlah_operator_desa_kelurahan','jumlah_berkas_pengurusan_yang_belum_selesai',
            'jumlah_berkas_pengurusan_yang_sudah_selesai',
            'jumlah_fasilitas_kesehatan','jumlah_operator_fasilitas_kesehatan',
            'jumlah_berkas_permohonan_dari_faskes_yang_belum_selesai','jumlah_berkas_permohonan_dari_faskes_yang_sudah_selesai',
            'jumlah_berkas_permohonan_dari_kua_yang_belum_selesai','jumlah_berkas_permohonan_dari_kua_yang_sudah_selesai',
            'jumlah_kua','jumlah_operator_kua'));
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function simpan_perubahan_data_profil_admin_data_dinas(Request $request){
        if (session()->has('LoggedAdminDataDinas')){
            $request->validate([
                'nama'=>'required',
                'jabatan'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nama.required'=>'Nama tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat dan Golongan tidak boleh kosong',
            ]);
            $admin_data = AdminDataDinas::find($request->id);
            $admin_data->nama = $request->nama;
            $admin_data->jabatan = $request->jabatan;
            $admin_data->pangkat_golongan = $request->pangkat_golongan;
            $admin_data->save();
            return redirect('dashboard_admin_data_dinas');
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function simpan_perubahan_data_password_admin_data_dinas(Request $request){
        if (session()->has('LoggedAdminDataDinas')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = AdminDataDinas::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_admin_data_dinas');
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function simpan_perubahan_data_foto_admin_data_dinas(Request $request){
        if (session()->has('LoggedAdminDataDinas')){
            $admin_data = AdminDataDinas::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_admin_data_dinas'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_admin_data_dinas');
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function logout_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            session()->pull('LoggedAdminDataDinas');
            return redirect('login_admin_data_dinas');
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function tampil_data_berkas_permohonan_dari_desa_belum_selesai_oleh_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $data_tabel = DB::table('berkas_pengurusans')
                        ->join('operator_desa_kelurahans', 'berkas_pengurusans.id_operator_desa_kelurahan', '=', 'operator_desa_kelurahans.id')
                        ->join('desa_kelurahans', 'operator_desa_kelurahans.id_desa_kelurahan', '=', 'desa_kelurahans.id')
                        ->join('kecamatans', 'desa_kelurahans.id_kecamatan', '=', 'kecamatans.id')
                        ->select('berkas_pengurusans.id',
                                'berkas_pengurusans.nama_pemohon',
                                'berkas_pengurusans.alamat_pemohon',
                                'berkas_pengurusans.jenis_permohonan',
                                'berkas_pengurusans.tanggal_pengajuan',
                                'desa_kelurahans.nama_desa_kelurahan',
                                'berkas_pengurusans.berkas_permohonan',
                                'kecamatans.nama_kecamatan',
                                'berkas_pengurusans.status')
                        ->where('berkas_pengurusans.status', '=', 'B')
                        ->orderBy('berkas_pengurusans.id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data_dinas.tampil_data_berkas_permohonan_dari_desa_belum_selesai_oleh_admin_data_dinas',$data);
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function get_id_berkas_pengurusan_by_admin_data_dinas($id){
        $data = BerkasPengurusan::find($id);
        return response()->json($data);
    }

    public function unggah_berkas_permohonan_selesai_oleh_admin_data_dinas(Request $request){
        $data_berkas_diperbaharui = BerkasPengurusan::find($request->id1);
        $request->validate([
            'file' => 'required|mimes:zip,rar',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('berkas_permohonan_selesai'),$filename);
        $data = $filename;
        $data_berkas_diperbaharui->berkas_selesai = $data;
        $tanggal_penyelesaian = date("d/m/Y");
        $data_berkas_diperbaharui->tanggal_penyelesaian = $tanggal_penyelesaian;
        $status = "S";
        $data_berkas_diperbaharui->status = $status;
        $data_berkas_diperbaharui->save();
        return response()->json($data_berkas_diperbaharui);
    }

    public function simpan_perubahan_data_catatan_penting_oleh_admin_data_dinas(Request $request){
        $data_perubahan = BerkasPengurusan::find($request->id);
        $data_perubahan->isi_canting = $request->isi_canting;
        $data_perubahan->dokumen_hasil = $request->dokumen_hasil;
        $data_perubahan->jml_kk = $request->jml_kk;
        $data_perubahan->jml_skp = $request->jml_skp;
        $data_perubahan->jml_kia = $request->jml_kia;
        $data_perubahan->jml_akta_kelahiran = $request->jml_akta_kelahiran;
        $data_perubahan->jml_akta_kematian = $request->jml_akta_kematian;
        $data_perubahan->jml_lain_lain = $request->jml_lain_lain;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tampil_data_berkas_permohonan_dari_desa_sudah_selesai_oleh_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $data_tabel = DB::table('berkas_pengurusans')
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data_dinas.tampil_data_berkas_permohonan_dari_desa_sudah_selesai_oleh_admin_data_dinas',$data);
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function tampil_data_berkas_permohonan_dari_faskes_belum_selesai_oleh_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
                        ->join('operator_fasilitas_kesehatans', 'berkas_permohonan_dari_faskes.id_operator_fasilitas_kesehatan', '=', 'operator_fasilitas_kesehatans.id')
                        ->join('fasilitas_kesehatans', 'operator_fasilitas_kesehatans.id_fasilitas_kesehatan', '=', 'fasilitas_kesehatans.id')
                        ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
                        ->select('berkas_permohonan_dari_faskes.id',
                                'berkas_permohonan_dari_faskes.nama_pemohon',
                                'berkas_permohonan_dari_faskes.alamat_pemohon',
                                'berkas_permohonan_dari_faskes.jenis_permohonan',
                                'berkas_permohonan_dari_faskes.tanggal_pengajuan',
                                'fasilitas_kesehatans.nama_fasilitas_kesehatan',
                                'berkas_permohonan_dari_faskes.berkas_permohonan',
                                'kecamatans.nama_kecamatan',
                                'berkas_permohonan_dari_faskes.status')
                        ->where('berkas_permohonan_dari_faskes.status', '=', 'B')
                        ->orderBy('berkas_permohonan_dari_faskes.id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data_dinas.tampil_data_berkas_permohonan_dari_faskes_belum_selesai_oleh_admin_data_dinas',$data);
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function get_id_berkas_permohonan_dari_faskes_by_admin_data_dinas($id){
        $data = BerkasPermohonanDariFaskes::find($id);
        return response()->json($data);
    }

    public function tampil_data_berkas_permohonan_dari_faskes_sudah_selesai_oleh_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data_dinas.tampil_data_berkas_permohonan_dari_faskes_sudah_selesai_oleh_admin_data_dinas',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function tampil_data_berkas_permohonan_dari_kua_belum_selesai_oleh_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
                        ->join('operator_kuas', 'berkas_permohonan_dari_kuas.id_operator_kua', '=', 'operator_kuas.id')
                        ->join('kuas', 'operator_kuas.id_kua', '=', 'kuas.id')
                        ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                        ->select('berkas_permohonan_dari_kuas.id',
                                'berkas_permohonan_dari_kuas.nama_pemohon',
                                'berkas_permohonan_dari_kuas.alamat_pemohon',
                                'berkas_permohonan_dari_kuas.jenis_permohonan',
                                'berkas_permohonan_dari_kuas.tanggal_pengajuan',
                                'kuas.nama_kua',
                                'berkas_permohonan_dari_kuas.berkas_permohonan',
                                'kecamatans.nama_kecamatan',
                                'berkas_permohonan_dari_kuas.status')
                        ->where('berkas_permohonan_dari_kuas.status', '=', 'B')
                        ->orderBy('berkas_permohonan_dari_kuas.id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data_dinas.tampil_data_berkas_permohonan_dari_kua_belum_selesai_oleh_admin_data_dinas',$data);
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

    public function tampil_data_berkas_permohonan_dari_kua_sudah_selesai_oleh_admin_data_dinas(){
        if (session()->has('LoggedAdminDataDinas')){
            $data_admin_untuk_dashboard = AdminDataDinas::where('id','=',session('LoggedAdminDataDinas'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data_dinas.tampil_data_berkas_permohonan_dari_kua_sudah_selesai_oleh_admin_data_dinas',$data);
        }else{
            return view('login.login_admin_data_dinas');
        }
    }

}
