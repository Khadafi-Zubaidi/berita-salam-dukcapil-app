<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Reporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReporterController extends Controller
{
    public function login_reporter(){
        return view('login.login_reporter');
    }

    public function cek_login_reporter(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required',
        ],[
            'nip.required'=>'NIP tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = Reporter::where('nip','=',$request->nip)->where('aktif','=','Y')->first();
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){
                $request->session()->put('LoggedReporter',$cek_login->id);
                return redirect('dashboard_reporter');
            }else{
                return redirect()->back()->with('error', 'Password salah !');
            }
        }else{
            return redirect()->back()->with('error', 'NIP tidak terdaftar !');
        }
    }

    public function dashboard_reporter(){
        if (session()->has('LoggedReporter')){
            $data_admin_untuk_dashboard = Reporter::where('id','=',session('LoggedReporter'))->first();
            $jumlah_berita = DB::table('beritas')
                ->where('id_reporter','=',$data_admin_untuk_dashboard->id)
                ->count();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('dashboard.dashboard_reporter',$data,compact('jumlah_berita'));
        }else{
            return view('login.login_reporter');
        }
    }

    public function simpan_perubahan_data_profil_reporter(Request $request){
        if (session()->has('LoggedReporter')){
            $request->validate([
                'nama'=>'required',
                'jabatan'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nama.required'=>'Nama tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat dan Golongan tidak boleh kosong',
            ]);
            $admin_data = Reporter::find($request->id);
            $admin_data->nama = $request->nama;
            $admin_data->jabatan = $request->jabatan;
            $admin_data->pangkat_golongan = $request->pangkat_golongan;
            $admin_data->save();
            return redirect('dashboard_reporter');
        }else{
            return view('login.login_reporter');
        }
    }

    public function simpan_perubahan_data_password_reporter(Request $request){
        if (session()->has('LoggedReporter')){
            $request->validate([
                'password_baru'=>'required',
            ],[
                'password_baru.required'=>'Password tidak boleh kosong',
            ]);
            $admin_data = Reporter::find($request->id);
            $admin_data->password = Hash::make($request->password_baru);
            $admin_data->save();
            return redirect('dashboard_reporter');
        }else{
            return view('login.login_reporter');
        }
    }

    public function simpan_perubahan_data_foto_reporter(Request $request){
        if (session()->has('LoggedReporter')){
            $admin_data = Reporter::find($request->id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('foto_reporter'),$filename);
            $data = $filename;
            $admin_data->foto = $data;
            $admin_data->save();
            return redirect('dashboard_reporter');
        }else{
            return view('login.login_reporter');
        }
    }

    public function logout_reporter(){
        if (session()->has('LoggedReporter')){
            session()->pull('LoggedReporter');
            return redirect('login_reporter');
        }else{
            return view('login.login_reporter');
        }
    }

    public function tampil_data_berita_oleh_reporter(){
        if (session()->has('LoggedReporter')){
            $data_admin_untuk_dashboard = Reporter::where('id','=',session('LoggedReporter'))->first();
            $data_tabel = Berita::orderBy('id', 'desc')
            ->where('id_reporter','=',$data_admin_untuk_dashboard->id)
            ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_reporter.tampil_data_berita_oleh_reporter',$data);
        }else{
            return view('login.login_reporter');
        }
        
    }

    public function get_id_berita_by_reporter1($id){
        $data = Berita::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_berita_oleh_reporter(Request $request){
        $data_perubahan = Berita::find($request->id);
        $data_perubahan->judul = $request->judul;
        $data_perubahan->isi_berita = $request->isi_berita;
        $data_perubahan->tanggal_berita = $request->tanggal_berita;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function get_id_berita_by_reporter2($id){
        $data = Berita::find($id);
        return response()->json($data);
    }

    public function updateDataFotoBerita(Request $request){
        $data_foto_diperbaharui = Berita::find($request->id4);
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('foto_berita'),$filename);
        $data = $filename;
        $data_foto_diperbaharui->foto = $data;
        $data_foto_diperbaharui->save();
        return response()->json($data_foto_diperbaharui);
    }

    public function tambah_data_berita_oleh_reporter(){
        if (session()->has('LoggedReporter')){
            $data_admin_untuk_dashboard = Reporter::where('id','=',session('LoggedReporter'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_reporter.tambah_data_berita_oleh_reporter',$data);
        }else{
            return view('login.login_reporter');
        }
    }

    public function simpan_data_baru_berita_oleh_reporter(Request $request){
        if (session()->has('LoggedReporter')){
            $request->validate([
                'judul'=>'required',
                'tanggal_berita'=>'required',
                'isi_berita'=>'required',
            ],[
                'judul.required'=>'Judul tidak boleh kosong',
                'tanggal_berita.required'=>'Tanggal Berita tidak boleh kosong',
                'isi_berita.required'=>'Isi Berita tidak boleh kosong',
            ]);
            $data_admin_untuk_dashboard = Reporter::where('id','=',session('LoggedReporter'))->first();

            $data_baru = new Berita();
            $data_baru->id_reporter = $data_admin_untuk_dashboard->id;
            $data_baru->judul = $request->judul;
            $data_baru->tanggal_berita = $request->tanggal_berita;
            $data_baru->isi_berita = $request->isi_berita;

            $data_baru->save();
            return redirect('tampil_data_berita_oleh_reporter');
        }else{
            return view('login.login_reporter');
        }
    }

    public function get_id_berita_by_reporter6($id){
        $data = Berita::find($id);
        return response()->json($data);
    }

    public function deleteData(Request $request){
        $data_berita_dihapus = Berita::find($request->id);
        $data_berita_dihapus->delete();
        return response()->json($data_berita_dihapus);
    }
}
