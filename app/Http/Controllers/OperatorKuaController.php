<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\OperatorKua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OperatorKuaController extends Controller
{
    
    public function tampil_data_operator_kua_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('operator_kuas')
                            ->join('kuas', 'operator_kuas.id_kua', '=', 'kuas.id')
                            ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                            ->select('operator_kuas.id',
                                     'operator_kuas.id_operator_kua',
                                     'operator_kuas.nama_operator',
                                     'operator_kuas.aktif',
                                     'operator_kuas.foto',
                                     'kuas.nama_kua',
                                     'kecamatans.nama_kecamatan')
                            ->orderBy('operator_kuas.id', 'asc')->get();

            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_operator_kua_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_operator_kua_by_admin_data($id){
        $data = OperatorKua::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_operator_kua_oleh_admin_data(Request $request){
        $data_perubahan = OperatorKua::find($request->id);
        $data_perubahan->nama_operator = $request->nama_operator;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function hapus_data_operator_kua_oleh_admin_data(Request $request){
        $data_dihapus = OperatorKua::find($request->id2);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function simpan_perubahan_data_password_operator_kua_oleh_admin_data(Request $request){
        $data_perubahan = OperatorKua::find($request->id3);
        $data_perubahan->password = Hash::make($request->password3);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_operator_kua_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_kua=DB::table('kuas')
                                    ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                                    ->select(
                                        'kuas.id',   
                                        'kuas.nama_kua',
                                        'kecamatans.nama_kecamatan'
                                    )
                                    ->orderBy('kuas.id', 'asc')->get();

            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataKua'=>$data_kua,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_operator_kua_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_operator_kua_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'id_kua'=>'required',
                'id_operator_kua'=>'required|unique:operator_kuas',
                'nama_operator'=>'required',
                'password'=>'required',
            ],[
                'id_kua.required'=>'ID KUA tidak boleh kosong',
                'id_operator_kua.required'=>'ID Operator tidak boleh kosong',
                'id_operator_kua.unique'=>'ID Operator sudah digunakan',
                'nama_operator.required'=>'Nama Operator tidak boleh kosong',
                'password.required'=>'Password tidak boleh kosong',
            ]);
            $data_baru = new OperatorKua();
            $data_baru->id_kua = $request->id_kua;
            $data_baru->id_operator_kua = $request->id_operator_kua;
            $data_baru->nama_operator = $request->nama_operator;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_operator_kua_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }
}
