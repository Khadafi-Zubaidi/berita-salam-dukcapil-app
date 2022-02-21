<?php

namespace App\Http\Controllers;

use App\Models\DesaKelurahan;
use App\Models\OperatorDesaKelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OperatorDesaKelurahanController extends Controller
{
    public function login_operator(){
        return view('login.login_operator');
    }

    public function cek_login_operator(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = OperatorDesaKelurahan::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedOperator',$cek_login->id);
                return redirect('dashboard_operator');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }

    public function dashboard_operator(){
        if (session()->has('LoggedOperator')){
            $data_admin_untuk_dashboard = OperatorDesaKelurahan::where('id','=',session('LoggedOperator'))->first();
            $nama_desa = DesaKelurahan::where('id','=',$data_admin_untuk_dashboard->id_desa_kelurahan)->first();
            $nama_kecamatan = DB::table('operator_desa_kelurahans')
                            ->join('desa_kelurahans', 'operator_desa_kelurahans.id_desa_kelurahan', '=', 'desa_kelurahans.id')
                            ->join('kecamatans', 'desa_kelurahans.id_kecamatan', '=', 'kecamatans.id')
                            ->select('kecamatans.nama_kecamatan')
                            ->where('operator_desa_kelurahans.id','=',session('LoggedOperator'))
                            ->first();
            $jumlah_berkas_pengurusan = DB::table('berkas_pengurusans')
                ->where('id_operator_desa_kelurahan','=',$data_admin_untuk_dashboard->id)
                ->count();
            $jumlah_berkas_pengurusan_yang_belum_selesai = DB::table('berkas_pengurusans')
                ->where('id_operator_desa_kelurahan','=',$data_admin_untuk_dashboard->id)
                ->where('status','=','B')
                ->count();
            $jumlah_berkas_pengurusan_yang_sudah_selesai = DB::table('berkas_pengurusans')
                ->where('id_operator_desa_kelurahan','=',$data_admin_untuk_dashboard->id)
                ->where('status','=','S')
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'NamaDesa'=>$nama_desa,
                'NamaKecamatan'=>$nama_kecamatan,
            ];
            return view('dashboard.dashboard_operator',$data,compact('jumlah_berkas_pengurusan','jumlah_berkas_pengurusan_yang_belum_selesai','jumlah_berkas_pengurusan_yang_sudah_selesai'));
        }else{
            return view('login.login_operator');
        }
    }

    public function simpan_perubahan_data_profil_operator(Request $request){
        if (session()->has('LoggedOperator')){
            $request->validate([
                'nama'=>'required',
                'jabatan'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nama.required'=>'Nama tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat dan Golongan tidak boleh kosong',
            ]);
            $admin_data = OperatorDesaKelurahan::find($request->id);
            $admin_data->nama = $request->nama;
            $admin_data->jabatan = $request->jabatan;
            $admin_data->pangkat_golongan = $request->pangkat_golongan;
            $admin_data->save();
            return redirect('dashboard_operator');
        }else{
            return view('login.login_operator');
        }
    }

    public function simpan_perubahan_data_password_operator(Request $request){
        if (session()->has('LoggedOperator')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = OperatorDesaKelurahan::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_operator');
        }else{
            return view('login.login_operator');
        }
    }

    public function simpan_perubahan_data_foto_operator(Request $request){
        if (session()->has('LoggedOperator')){
            $admin_data = OperatorDesaKelurahan::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_operator_desa_kelurahan'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_operator');
        }else{
            return view('login.login_operator');
        }
    }

    public function logout_operator(){
        if (session()->has('LoggedOperator')){
            session()->pull('LoggedOperator');
            return redirect('login_operator');
        }else{
            return view('login.login_operator');
        }
    }
}
