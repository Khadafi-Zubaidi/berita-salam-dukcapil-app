<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\FasilitasKesehatan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasKesehatanController extends Controller
{
    
    public function tampil_data_fasilitas_kesehatan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('fasilitas_kesehatans')
                            ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
                            ->select('fasilitas_kesehatans.id',
                                     'fasilitas_kesehatans.nama_fasilitas_kesehatan',
                                     'kecamatans.nama_kecamatan')
                            ->orderBy('fasilitas_kesehatans.id', 'asc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_fasilitas_kesehatan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_fasilitas_kesehatan_by_admin_data($id){
        $data = FasilitasKesehatan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_fasilitas_kesehatan_oleh_admin_data(Request $request){
        $data_perubahan = FasilitasKesehatan::find($request->id);
        $data_perubahan->nama_fasilitas_kesehatan = $request->nama_fasilitas_kesehatan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_fasilitas_kesehatan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_kecamatan=Kecamatan::all();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataKecamatan'=>$data_kecamatan,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_fasilitas_kesehatan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_fasilitas_kesehatan_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'id_kecamatan'=>'required',
                'nama_fasilitas_kesehatan'=>'required',
            ],[
                'id_kecamatan.required'=>'ID Kecamatan tidak boleh kosong',
                'nama_fasilitas_kesehatan.required'=>'Nama Fasilitas Kesehatan tidak boleh kosong',
            ]);
            $data_baru = new FasilitasKesehatan();
            $data_baru->id_kecamatan = $request->id_kecamatan;
            $data_baru->nama_fasilitas_kesehatan = $request->nama_fasilitas_kesehatan;
            $data_baru->save();
            return redirect('tampil_data_fasilitas_kesehatan_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }
}
