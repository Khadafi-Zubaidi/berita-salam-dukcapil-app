<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\Kecamatan;
use App\Models\Kua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuaController extends Controller
{

    public function tampil_data_kua_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('kuas')
                            ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                            ->select('kuas.id',
                                     'kuas.nama_kua',
                                     'kecamatans.nama_kecamatan')
                            ->orderBy('kuas.id', 'asc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_kua_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_kua_by_admin_data($id){
        $data = Kua::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_kua_oleh_admin_data(Request $request){
        $data_perubahan = Kua::find($request->id);
        $data_perubahan->nama_kua = $request->nama_kua;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_kua_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_kecamatan=Kecamatan::all();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataKecamatan'=>$data_kecamatan,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_kua_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_kua_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'id_kecamatan'=>'required',
                'nama_kua'=>'required',
            ],[
                'id_kecamatan.required'=>'ID Kecamatan tidak boleh kosong',
                'nama_kua.required'=>'Nama KUA tidak boleh kosong',
            ]);
            $data_baru = new Kua();
            $data_baru->id_kecamatan = $request->id_kecamatan;
            $data_baru->nama_kua = $request->nama_kua;
            $data_baru->save();
            return redirect('tampil_data_kua_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }
}
