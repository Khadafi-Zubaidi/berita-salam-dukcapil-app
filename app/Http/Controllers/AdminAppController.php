<?php

namespace App\Http\Controllers;

use App\Models\AdminApp;
use App\Models\AdminData;
use App\Models\Redaktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAppController extends Controller
{
    public function register_admin_app(){
        return view('register.register_admin_app');
    }

    public function simpan_data_baru_admin_app(Request $request){
        $request->validate([
            'nip'=>'required|unique:admin_apps',
            'nama'=>'required',
            'password'=>'required',
            'kode_validasi'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'nip.unique'=>'NIP sudah digunakan',
            'nama.required'=>'Nama tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
            'kode_validasi.required'=>'Kode Validasi tidak boleh kosong',
        ]);
        $kode_validasi = $request->kode_validasi;
        if($kode_validasi === '6yfdh3&n-S7X#E@E'){
            $data_baru = new AdminApp();
            $data_baru->nip = $request->nip;
            $data_baru->nama = $request->nama;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('register_admin_app');
        }
    }

    public function login_admin_app(){
        return view('login.login_admin_app');
    }

    public function cek_login_admin_app(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = AdminApp::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedAdminApp',$cek_login->id);
                return redirect('dashboard_admin_app');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }

    public function dashboard_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $jumlah_redaktur = DB::table('redakturs')
                ->count();
            $jumlah_admin_data = DB::table('admin_data')
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('dashboard.dashboard_admin_app',$data,compact('jumlah_redaktur','jumlah_admin_data'));
        }else{
            return view('login.login_admin_app');
        }
    }

    public function simpan_perubahan_data_profil_admin_app(Request $request){
        if (session()->has('LoggedAdminApp')){
            $request->validate([
                'nama'=>'required',
            ],[
                'nama.required'=>'Nama tidak boleh kosong',
            ]);
            $admin_data = AdminApp::find($request->id);
            $admin_data->nama = $request->nama;
            $admin_data->save();
            return redirect('dashboard_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    public function simpan_perubahan_data_password_admin_app(Request $request){
        if (session()->has('LoggedAdminApp')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = AdminApp::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    public function simpan_perubahan_data_foto_admin_app(Request $request){
        if (session()->has('LoggedAdminApp')){
            $admin_data = AdminApp::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_admin_app'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    public function logout_admin_app(){
        if (session()->has('LoggedAdminApp')){
            session()->pull('LoggedAdminApp');
            return redirect('login_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    public function tampil_data_redaktur_oleh_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $data_tabel = Redaktur::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_app.tampil_data_redaktur_oleh_admin_app',$data);
        }else{
            return view('login.login_admin_app');
        }
        
    }

    public function get_id_redaktur_by_admin_app($id){
        $data = Redaktur::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_redaktur_oleh_admin_app(Request $request){
        $data_perubahan = Redaktur::find($request->id);
        $data_perubahan->nip = $request->nip;
        $data_perubahan->nama = $request->nama;
        $data_perubahan->jabatan = $request->jabatan;
        $data_perubahan->pangkat_golongan = $request->pangkat_golongan;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function simpan_perubahan_data_password_redaktur_oleh_admin_app(Request $request){
        $data_perubahan = Redaktur::find($request->id);
        $data_perubahan->password = Hash::make($request->password);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_redaktur_oleh_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_admin_app.tambah_data_redaktur_oleh_admin_app',$data);
        }else{
            return view('login.login_admin_app');
        }
    }

    public function simpan_data_baru_redaktur_oleh_admin_app(Request $request){
        if (session()->has('LoggedAdminApp')){
            $request->validate([
                'nip'=>'required|unique:redakturs',
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
            $data_baru = new Redaktur();
            $data_baru->nip = $request->nip;
            $data_baru->nama = $request->nama;
            $data_baru->jabatan = $request->jabatan;
            $data_baru->pangkat_golongan = $request->pangkat_golongan;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_redaktur_oleh_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    public function tampil_data_admin_data_oleh_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $data_tabel = AdminData::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_app.tampil_data_admin_data_oleh_admin_app',$data);
        }else{
            return view('login.login_admin_app');
        }
        
    }

    public function get_id_admin_data_by_admin_app($id){
        $data = AdminData::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_admin_data_oleh_admin_app(Request $request){
        $data_perubahan = AdminData::find($request->id);
        $data_perubahan->nip = $request->nip;
        $data_perubahan->nama = $request->nama;
        $data_perubahan->jabatan = $request->jabatan;
        $data_perubahan->pangkat_golongan = $request->pangkat_golongan;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function simpan_perubahan_data_password_admin_data_oleh_admin_app(Request $request){
        $data_perubahan = AdminData::find($request->id);
        $data_perubahan->password = Hash::make($request->password);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_admin_data_oleh_admin_app(){
        if (session()->has('LoggedAdminApp')){
            $data_admin_untuk_dashboard = AdminApp::where('id','=',session('LoggedAdminApp'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_admin_app.tambah_data_admin_data_oleh_admin_app',$data);
        }else{
            return view('login.login_admin_app');
        }
    }

    public function simpan_data_baru_admin_data_oleh_admin_app(Request $request){
        if (session()->has('LoggedAdminApp')){
            $request->validate([
                'nip'=>'required|unique:admin_data',
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
            $data_baru = new AdminData();
            $data_baru->nip = $request->nip;
            $data_baru->nama = $request->nama;
            $data_baru->jabatan = $request->jabatan;
            $data_baru->pangkat_golongan = $request->pangkat_golongan;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_admin_data_oleh_admin_app');
        }else{
            return view('login.login_admin_app');
        }
    }

    
}
