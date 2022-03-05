<?php

namespace App\Http\Controllers;

use App\Models\AdminApp;
use App\Models\AdminDataDinas;
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

}
