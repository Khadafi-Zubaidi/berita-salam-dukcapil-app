<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\Kua;
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
                                     'operator_kuas.no_wa',
                                     'operator_kuas.aktif',
                                     'operator_kuas.foto',
                                     'operator_kuas.berkas',
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
        $data_perubahan->no_wa = $request->no_wa;
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
                'no_wa'=>'required',
                'password'=>'required',
            ],[
                'id_kua.required'=>'ID KUA tidak boleh kosong',
                'id_operator_kua.required'=>'ID Operator tidak boleh kosong',
                'id_operator_kua.unique'=>'ID Operator sudah digunakan',
                'nama_operator.required'=>'Nama Operator tidak boleh kosong',
                'no_wa.required'=>'Nomor Telp. / WA. tidak boleh kosong',
                'password.required'=>'Password tidak boleh kosong',
            ]);
            $data_baru = new OperatorKua();
            $data_baru->id_kua = $request->id_kua;
            $data_baru->id_operator_kua = $request->id_operator_kua;
            $data_baru->nama_operator = $request->nama_operator;
            $data_baru->no_wa = $request->no_wa;
            $data_baru->password = Hash::make($request->password);
            $data_baru->save();
            return redirect('tampil_data_operator_kua_oleh_admin_data');
        }else{
            return view('login.login_admin_data');
        }
    }

    public function login_operator_kua(){
        return view('login.login_operator_kua');
    }

    public function cek_login_operator_kua(Request $request){
        $request->validate([
            'id_operator_kua'=>'required',
            'password'=>'required',
        ],[
            'id_operator_kua.required'=>'ID Operator tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = OperatorKua::where('id_operator_kua','=',$request->id_operator_kua)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedOperatorKUA',$cek_login->id);
                return redirect('dashboard_operator_kua');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'ID Operator tidak terdaftar !');
        }
    }

    public function dashboard_operator_kua(){
        if (session()->has('LoggedOperatorKUA')){
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            $nama_kua = Kua::where('id','=',$data_admin_untuk_dashboard->id_kua)->first();
            $nama_kecamatan = DB::table('operator_kuas')
                            ->join('kuas', 'operator_kuas.id_kua', '=', 'kuas.id')
                            ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                            ->select('kecamatans.nama_kecamatan')
                            ->where('operator_kuas.id','=',session('LoggedOperatorKUA'))
                            ->first();
            $jumlah_berkas_permohonan_dari_kua = DB::table('berkas_permohonan_dari_kuas')
                ->where('id_operator_kua','=',$data_admin_untuk_dashboard->id)
                ->count();
            $jumlah_berkas_permohonan_dari_kua_yang_belum_selesai = DB::table('berkas_permohonan_dari_kuas')
                ->where('id_operator_kua','=',$data_admin_untuk_dashboard->id)
                ->where('status','=','B')
                ->count();
            $jumlah_berkas_permohonan_dari_kua_yang_sudah_selesai = DB::table('berkas_permohonan_dari_kuas')
                ->where('id_operator_kua','=',$data_admin_untuk_dashboard->id)
                ->where('status','=','S')
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
                'NamaKUA'=>$nama_kua,
                'NamaKecamatan'=>$nama_kecamatan,
            ];
            return view('dashboard.dashboard_operator_kua',$data,compact(
                'jumlah_berkas_permohonan_dari_kua',
            'jumlah_berkas_permohonan_dari_kua_yang_belum_selesai',
            'jumlah_berkas_permohonan_dari_kua_yang_sudah_selesai'));
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function simpan_perubahan_data_profil_operator_kua(Request $request){
        if (session()->has('LoggedOperatorKUA')){
            $request->validate([
                'nama_operator'=>'required',
                'no_wa'=>'required',
            ],[
                'nama_operator.required'=>'Nama Operator tidak boleh kosong',
                'no_wa.required'=>'No Telp./WA. tidak boleh kosong',
            ]);
            $admin_data = OperatorKua::find($request->id);
            $admin_data->nama_operator = $request->nama_operator;
            $admin_data->no_wa = $request->no_wa;
            $admin_data->save();
            return redirect('dashboard_operator_kua');
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function simpan_perubahan_data_password_operator_kua(Request $request){
        if (session()->has('LoggedOperatorKUA')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = OperatorKua::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_operator_kua');
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function simpan_perubahan_data_foto_operator_kua(Request $request){
        if (session()->has('LoggedOperatorKUA')){
            $admin_data = OperatorKua::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_operator_kua'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_operator_kua');
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function simpan_perubahan_data_berkas_operator_kua(Request $request){
        if (session()->has('LoggedOperatorKUA')){
            $admin_data = OperatorKua::find($request->id);
            $request->validate([
                'file2' => 'required|mimes:zip,rar',
            ]);
            $extension = $request->file2->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file2->move(public_path('berkas_operator_kua'),$filename);
            $data = $filename;
            $admin_data->berkas = $data;
            $admin_data->save();
            return redirect('dashboard_operator_kua');
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function logout_operator_kua(){
        if (session()->has('LoggedOperatorKUA')){
            session()->pull('LoggedOperatorKUA');
            return redirect('login_operator_kua');
        }else{
            return view('login.login_operator_kua');
        }
    }
}
