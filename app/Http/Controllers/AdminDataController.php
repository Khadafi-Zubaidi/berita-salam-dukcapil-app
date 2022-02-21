<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\DesaKelurahan;
use App\Models\Kecamatan;
use App\Models\OperatorDesaKelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDataController extends Controller
{
    public function login_admin_data(){
        return view('login.login_admin_data');
    }

    public function cek_login_admin_data(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = AdminData::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedAdminData',$cek_login->id);
                return redirect('dashboard_admin_data');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }

    public function dashboard_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $jumlah_kecamatan = DB::table('kecamatans')
                ->count();
            $jumlah_desa_kelurahan = DB::table('desa_kelurahans')
                ->count();
            $jumlah_operator_desa_kelurahan = DB::table('operator_desa_kelurahans')
                ->count();
            $jumlah_berkas_pengurusan_yang_belum_selesai = DB::table('berkas_pengurusans')
                ->where('status','=','B')
                ->count();
            $jumlah_berkas_pengurusan_yang_sudah_selesai = DB::table('berkas_pengurusans')
                ->where('status','=','S')
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('dashboard.dashboard_admin_data',$data,compact('jumlah_kecamatan','jumlah_desa_kelurahan','jumlah_operator_desa_kelurahan','jumlah_berkas_pengurusan_yang_belum_selesai','jumlah_berkas_pengurusan_yang_sudah_selesai'));
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_perubahan_data_profil_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'nama'=>'required',
                'jabatan'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nama.required'=>'Nama tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat dan Golongan tidak boleh kosong',
            ]);
            $admin_data = AdminData::find($request->id);
            $admin_data->nama = $request->nama;
            $admin_data->jabatan = $request->jabatan;
            $admin_data->pangkat_golongan = $request->pangkat_golongan;
            $admin_data->save();
            return redirect('dashboard_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_perubahan_data_password_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = AdminData::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_perubahan_data_foto_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $admin_data = AdminData::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_admin_data'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function logout_admin_data(){
        if (session()->has('LoggedAdminData')){
            session()->pull('LoggedAdminData');
            return redirect('login_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function tampil_data_kecamatan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = Kecamatan::orderBy('id', 'desc')->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_kecamatan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_kecamatan_by_admin_data($id){
        $data = Kecamatan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_kecamatan_oleh_admin_data(Request $request){
        $data_perubahan = Kecamatan::find($request->id);
        $data_perubahan->nama_kecamatan = $request->nama_kecamatan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_kecamatan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_kecamatan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_kecamatan_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'kode_wilayah_kecamatan'=>'required|unique:kecamatans',
                'nama_kecamatan'=>'required',
            ],[
                'kode_wilayah_kecamatan.required'=>'Kode Wilayah Kecamatan tidak boleh kosong',
                'kode_wilayah_kecamatan.unique'=>'Kode Wilayah Kecamatan sudah digunakan',
                'nama_kecamatan.required'=>'Nama Kecamatan tidak boleh kosong',
            ]);
            $data_baru = new Kecamatan();
            $data_baru->kode_wilayah_kecamatan = $request->kode_wilayah_kecamatan;
            $data_baru->nama_kecamatan = $request->nama_kecamatan;
            $data_baru->save();
            return redirect('tampil_data_kecamatan_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function tampil_data_desa_kelurahan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('desa_kelurahans')
                            ->join('kecamatans', 'desa_kelurahans.id_kecamatan', '=', 'kecamatans.id')
                            ->select('desa_kelurahans.id',
                                     'desa_kelurahans.kode_wilayah_desa_kelurahan',
                                     'desa_kelurahans.nama_desa_kelurahan',
                                     'kecamatans.nama_kecamatan')
                            ->orderBy('desa_kelurahans.id', 'asc')->get();

            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_desa_kelurahan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_desa_kelurahan_by_admin_data($id){
        $data = DesaKelurahan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_desa_kelurahan_oleh_admin_data(Request $request){
        $data_perubahan = DesaKelurahan::find($request->id);
        $data_perubahan->nama_desa_kelurahan = $request->nama_desa_kelurahan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_desa_kelurahan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_kecamatan=Kecamatan::all();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataKecamatan'=>$data_kecamatan,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_desa_kelurahan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_desa_kelurahan_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'id_kecamatan'=>'required',
                'kode_wilayah_desa_kelurahan'=>'required|unique:desa_kelurahans',
                'nama_desa_kelurahan'=>'required',
            ],[
                'id_kecamatan.required'=>'ID Kecamatan tidak boleh kosong',
                'kode_wilayah_desa_kelurahan.required'=>'Kode Wilayah Desa/Kelurahan tidak boleh kosong',
                'kode_wilayah_desa_kelurahan.unique'=>'Kode Wilayah Desa/Kelurahan sudah digunakan',
                'nama_desa_kelurahan.required'=>'Nama Desa/Kelurahan tidak boleh kosong',
            ]);
            $data_baru = new DesaKelurahan();
            $data_baru->id_kecamatan = $request->id_kecamatan;
            $data_baru->kode_wilayah_desa_kelurahan = $request->kode_wilayah_desa_kelurahan;
            $data_baru->nama_desa_kelurahan = $request->nama_desa_kelurahan;
            $data_baru->save();
            return redirect('tampil_data_desa_kelurahan_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function tampil_data_operator_desa_kelurahan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('operator_desa_kelurahans')
                            ->join('desa_kelurahans', 'operator_desa_kelurahans.id_desa_kelurahan', '=', 'desa_kelurahans.id')
                            ->join('kecamatans', 'desa_kelurahans.id_kecamatan', '=', 'kecamatans.id')
                            ->select('operator_desa_kelurahans.id',
                                     'operator_desa_kelurahans.nip',
                                     'operator_desa_kelurahans.nama_operator',
                                     'operator_desa_kelurahans.jabatan',
                                     'operator_desa_kelurahans.pangkat_golongan',
                                     'operator_desa_kelurahans.aktif',
                                     'operator_desa_kelurahans.foto',
                                     'desa_kelurahans.nama_desa_kelurahan',
                                     'kecamatans.nama_kecamatan')
                            ->orderBy('operator_desa_kelurahans.id', 'asc')->get();

            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_operator_desa_kelurahan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function get_id_operator_desa_kelurahan_by_admin_data($id){
        $data = OperatorDesaKelurahan::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_operator_desa_kelurahan_oleh_admin_data(Request $request){
        $data_perubahan = OperatorDesaKelurahan::find($request->id);
        $data_perubahan->nip = $request->nip;
        $data_perubahan->nama_operator = $request->nama_operator;
        $data_perubahan->jabatan = $request->jabatan;
        $data_perubahan->pangkat_golongan = $request->pangkat_golongan;
        $data_perubahan->aktif = $request->aktif;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function tambah_data_operator_desa_kelurahan_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_desa_kelurahan=DB::table('desa_kelurahans')
                                    ->join('kecamatans', 'desa_kelurahans.id_kecamatan', '=', 'kecamatans.id')
                                    ->select(
                                        'desa_kelurahans.id',   
                                        'desa_kelurahans.nama_desa_kelurahan',
                                        'kecamatans.nama_kecamatan'
                                    )
                                    ->orderBy('desa_kelurahans.id', 'asc')->get();

            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'DataDesaKelurahan'=>$data_desa_kelurahan,
            ];
            return view('tambah_data_oleh_admin_data.tambah_data_operator_desa_kelurahan_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_data_baru_operator_desa_kelurahan_oleh_admin_data(Request $request){
        if (session()->has('LoggedAdminData')){
            $request->validate([
                'id_desa_kelurahan'=>'required',
                'nip'=>'required',
                'nama_operator'=>'required',
                'jabatan'=>'required',
                'password'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'id_desa_kelurahan.required'=>'ID Desa/Kelurahan tidak boleh kosong',
                'nip.required'=>'NIP tidak boleh kosong',
                'nama_operator.required'=>'Nama Operator tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'password.required'=>'Password tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat/Golongan tidak boleh kosong',
            ]);
            $data_baru = new OperatorDesaKelurahan();
            $data_baru->id_desa_kelurahan = $request->id_desa_kelurahan;
            $data_baru->nip = $request->nip;
            $data_baru->nama_operator = $request->nama_operator;
            $data_baru->jabatan = $request->jabatan;
            $data_baru->password = Hash::make($request->password);
            $data_baru->pangkat_golongan = $request->pangkat_golongan;
            $data_baru->save();
            return redirect('tampil_data_operator_desa_kelurahan_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function hapus_data_operator_desa_kelurahan(Request $request){
        $data_dihapus = OperatorDesaKelurahan::find($request->id2);
        $data_dihapus->delete();
        return response()->json($data_dihapus);
    }

    public function simpan_perubahan_data_password_operator_desa_kelurahan_oleh_admin_data(Request $request){
        $data_perubahan = OperatorDesaKelurahan::find($request->id3);
        $data_perubahan->password = Hash::make($request->password3);
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }
    
}
