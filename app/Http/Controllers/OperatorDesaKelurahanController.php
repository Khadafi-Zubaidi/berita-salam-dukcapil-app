<?php

namespace App\Http\Controllers;

use App\Models\BerkasPengurusan;
use App\Models\DesaKelurahan;
use App\Models\OperatorDesaKelurahan;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


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
            'nip.required'=>'ID Operator tidak boleh kosong',
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
                'nama_operator'=>'required',
                'jabatan'=>'required',
                'pangkat_golongan'=>'required',
            ],[
                'nama_operator.required'=>'Nama Operator tidak boleh kosong',
                'jabatan.required'=>'Jabatan tidak boleh kosong',
                'pangkat_golongan.required'=>'Pangkat dan Golongan tidak boleh kosong',
            ]);
            $admin_data = OperatorDesaKelurahan::find($request->id);
            $admin_data->nama_operator = $request->nama_operator;
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

    public function tambah_data_berkas_oleh_operator(){
        if (session()->has('LoggedOperator')){
            $data_admin_untuk_dashboard = OperatorDesaKelurahan::where('id','=',session('LoggedOperator'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_operator.tambah_data_berkas_oleh_operator',$data);
        }else{
            return view('login.login_redaktur');
        }
    }

    public function simpan_data_baru_permohonan_oleh_operator(Request $request){
        if (session()->has('LoggedOperator')){
            $request->validate([
                'nama_pemohon'=>'required',
                'alamat_pemohon'=>'required',
                'jenis_permohonan'=>'required',
                'file' => 'required|mimes:zip',
            ],[
                'nama_pemohon.required'=>'Nama Pemohon tidak boleh kosong',
                'alamat_pemohon.required'=>'Alamat Pemohon tidak boleh kosong',
                'jenis_permohonan.required'=>'Jenis Permohonan tidak boleh kosong',
                'file.required'=>'Berkas tidak boleh kosong',
                'file.mimes'=>'Berkas harus dalam bentuk (ZIP)',
            ]);
            $data_admin_untuk_dashboard = OperatorDesaKelurahan::where('id','=',session('LoggedOperator'))->first();

            $data_baru = new BerkasPengurusan();
            $data_baru->id_operator_desa_kelurahan = $data_admin_untuk_dashboard->id;
            $data_baru->id_desa_kelurahan = $data_admin_untuk_dashboard->id_desa_kelurahan;
            $data_baru->nama_pemohon = $request->nama_pemohon;
            $data_baru->alamat_pemohon = $request->alamat_pemohon;
            $data_baru->jenis_permohonan = $request->jenis_permohonan;
            $tanggal_pengajuan = date("d/m/Y");
            $data_baru->tanggal_pengajuan = $tanggal_pengajuan;
            $bulan_pengajuan = date("m");
            $data_baru->bulan_pengajuan = $bulan_pengajuan;
            //simpan berkas
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('berkas_permohonan'),$filename);
            $data = $filename;
            $data_baru->berkas_permohonan = $data;
            //akhir simpan berkas
            //generate random string untuk nomor pendaftaran
            $randomString = Str::random(10);
            $data_baru->nomor_pendaftaran = $randomString;
            $data_baru->save();
            return redirect('dashboard_operator');
        }else{
            return view('login.login_operator');
        }
    }

    public function tampil_data_berkas_permohonan_belum_selesai_oleh_operator(){
        if (session()->has('LoggedOperator')){
            $data_admin_untuk_dashboard = OperatorDesaKelurahan::where('id','=',session('LoggedOperator'))->first();
            $data_tabel = DB::table('berkas_pengurusans')
                        ->where('id_operator_desa_kelurahan','=',$data_admin_untuk_dashboard->id)
                        ->where('status', '=', 'B')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_operator.tampil_data_berkas_permohonan_belum_selesai_oleh_operator',$data);
        }else{
            return view('login.login_operator');
        }
    }

    public function unggah_berkas_permohonan_lagi_oleh_operator(Request $request){
        $data_berkas_diperbaharui = BerkasPengurusan::find($request->id1);
        $request->validate([
            'file' => 'required|mimes:zip',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('berkas_permohonan'),$filename);
        $data = $filename;
        $data_berkas_diperbaharui->berkas_permohonan = $data;
        $tanggal_pengajuan = date("d/m/Y");
        $data_berkas_diperbaharui->tanggal_pengajuan = $tanggal_pengajuan;
        $data_berkas_diperbaharui->save();
        return response()->json($data_berkas_diperbaharui);
    }

    public function tampil_data_berkas_permohonan_sudah_selesai_oleh_operator(){
        if (session()->has('LoggedOperator')){
            $data_admin_untuk_dashboard = OperatorDesaKelurahan::where('id','=',session('LoggedOperator'))->first();
            $data_tabel = DB::table('berkas_pengurusans')
                        ->where('id_operator_desa_kelurahan','=',$data_admin_untuk_dashboard->id)
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_operator.tampil_data_berkas_permohonan_sudah_selesai_oleh_operator',$data);
        }else{
            return view('login.login_operator');
        }
    }

    public function cetak_bukti_pendaftaran_oleh_operator($id){
        //$data_admin_untuk_dashboard = OperatorDesaKelurahan::where('id','=',session('LoggedOperator'))->first();
        //$data_desa_kelurahan = DB::table('berkas_pengurusans')
        $data_berkas = BerkasPengurusan::find($id);
        //$pdf = Pdf::loadView('bukti_pendaftaran', compact('data_berkas'));
        $pdf = Pdf::loadView('bukti_pendaftaran.bukti_pendaftaran', compact('data_berkas'));
        return $pdf->download('bukti_pendaftaran.pdf');
    }

}
