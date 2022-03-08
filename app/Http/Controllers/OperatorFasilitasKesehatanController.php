<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\OperatorDesaKelurahan;
use App\Models\OperatorFasilitasKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OperatorFasilitasKesehatanController extends Controller
{
    
    public function tampil_data_operator_fasilitas_kesehatan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('operator_fasilitas_kesehatans')
                            ->join('fasilitas_kesehatans', 'operator_fasilitas_kesehatans.id_fasilitas_kesehatan', '=', 'fasilitas_kesehatans.id')
                            ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
                            ->select('operator_fasilitas_kesehatans.id',
                                     'operator_fasilitas_kesehatans.id_operator_fasilitas_kesehatan',
                                     'operator_fasilitas_kesehatans.nama_operator',
                                     'operator_fasilitas_kesehatans.aktif',
                                     'operator_fasilitas_kesehatans.foto',
                                     'fasilitas_kesehatans.nama_fasilitas_kesehatan',
                                     'kecamatans.nama_kecamatan')
                            ->orderBy('operator_fasilitas_kesehatans.id', 'asc')->get();

            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_operator_fasilitas_kesehatan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_operator_fasilitas_kesehatan_by_admin_data($id){
        $data = OperatorFasilitasKesehatan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_operator_fasilitas_kesehatan_oleh_admin_data(Request $request){
        $data_perubahan = OperatorFasilitasKesehatan::find($request->id);
        $data_perubahan->nama_operator = $request->nama_operator;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function hapus_data_operator_fasilitas_kesehatan_oleh_admin_data(Request $request){
        $data_dihapus = OperatorFasilitasKesehatan::find($request->id2);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function simpan_perubahan_data_password_operator_fasilitas_kesehatan_oleh_admin_data(Request $request){
        $data_perubahan = OperatorFasilitasKesehatan::find($request->id3);
        $data_perubahan->password = Hash::make($request->password3);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_operator_fasilitas_kesehatan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_fasilitas_kesehatan=DB::table('fasilitas_kesehatans')
                                    ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
                                    ->select(
                                        'fasilitas_kesehatans.id',   
                                        'fasilitas_kesehatans.nama_fasilitas_kesehatan',
                                        'kecamatans.nama_kecamatan'
                                    )
                                    ->orderBy('fasilitas_kesehatans.id', 'asc')->get();

            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataFasilitasKesehatan'=>$data_fasilitas_kesehatan,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_operator_fasilitas_kesehatan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_operator_fasilitas_kesehatan_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'id_fasilitas_kesehatan'=>'required',
                'id_operator_fasilitas_kesehatan'=>'required|unique:operator_fasilitas_kesehatans',
                'nama_operator'=>'required',
                'password'=>'required',
            ],[
                'id_fasilitas_kesehatan.required'=>'ID Fasilitas Kesehatan tidak boleh kosong',
                'id_operator_fasilitas_kesehatan.required'=>'ID Operator tidak boleh kosong',
                'id_operator_fasilitas_kesehatan.unique'=>'ID Operator sudah digunakan',
                'nama_operator.required'=>'Nama Operator tidak boleh kosong',
                'password.required'=>'Password tidak boleh kosong',
            ]);
            $data_baru = new OperatorFasilitasKesehatan();
            $data_baru->id_fasilitas_kesehatan = $request->id_fasilitas_kesehatan;
            $data_baru->id_operator_fasilitas_kesehatan = $request->id_operator_fasilitas_kesehatan;
            $data_baru->nama_operator = $request->nama_operator;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_operator_fasilitas_kesehatan_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function login_operator_faskes(){
        return view('login.login_operator_faskes');
    }

    public function cek_login_operator_faskes(Request $request){
        $request->validate([
            'cek_login_operator_faskes'=>'required',
            'password'=>'required',
        ],[
            'cek_login_operator_faskes.required'=>'ID Operator tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = OperatorFasilitasKesehatan::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedOperatorFasilitasKesehatan',$cek_login->id);
                return redirect('dashboard_operator_faskes');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }
}
