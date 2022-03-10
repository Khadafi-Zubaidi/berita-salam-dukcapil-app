<?php

namespace App\Http\Controllers;

use App\Models\BerkasPermohonanDariKua;
use App\Models\OperatorKua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKuaBulanTahunExport;
use App\Models\AdminData;

class BerkasPermohonanDariKuaController extends Controller
{

    public function tambah_data_berkas_permohonan_oleh_operator_kua(){
        if (session()->has('LoggedOperatorKUA')){
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_operator_kua.tambah_data_berkas_permohonan_oleh_operator_kua',$data);
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function simpan_data_baru_permohonan_oleh_operator_kua(Request $request){
        if (session()->has('LoggedOperatorKUA')){
            $request->validate([
                'nik_pemohon'=>'required',
                'nama_pemohon'=>'required',
                'alamat_pemohon'=>'required',
                'jenis_permohonan'=>'required',
                'file' => 'required|mimes:zip,rar',
            ],[
                'nik_pemohon.required'=>'NIK Pemohon tidak boleh kosong',
                'nama_pemohon.required'=>'Nama Pemohon tidak boleh kosong',
                'alamat_pemohon.required'=>'Alamat Pemohon tidak boleh kosong',
                'jenis_permohonan.required'=>'Jenis Permohonan tidak boleh kosong',
                'file.required'=>'Berkas tidak boleh kosong',
                'file.mimes'=>'Berkas harus dalam bentuk (ZIP/RAR)',
            ]);
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            //$id_operator = $data_admin_untuk_dashboard->id;
            //$id_desa_kul = $data_admin_untuk_dashboard->id_desa_kelurahan;
            //get nama desa
            $data_nama_kua = DB::table('kuas')
                                ->select('kuas.nama_kua')
                                ->where('kuas.id','=',$data_admin_untuk_dashboard->id_kua)
                                ->get();
            //get nama kecamatan
            $data_nama_kecamatan  = DB::table('operator_kuas')
                                ->join('kuas', 'operator_kuas.id_kua', '=', 'kuas.id')
                                ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                                ->select('kecamatans.nama_kecamatan')
                                ->where('operator_kuas.id','=',$data_admin_untuk_dashboard->id)
                                ->get();
            $data_baru = new BerkasPermohonanDariKua();
            $data_baru->id_operator_kua = $data_admin_untuk_dashboard->id;
            $data_baru->id_kua = $data_admin_untuk_dashboard->id_kua;
            $data_baru->nik_pemohon = $request->nik_pemohon;
            $data_baru->nama_pemohon = $request->nama_pemohon;
            $data_baru->alamat_pemohon = $request->alamat_pemohon;
            $data_baru->jenis_permohonan = $request->jenis_permohonan;
            $tanggal_pengajuan = date("d/m/Y");
            $data_baru->tanggal_pengajuan = $tanggal_pengajuan;
            $bulan_pengajuan = date("m");
            //konversi angka bulan ke nama bulan
            if($bulan_pengajuan=="01") {
                $nama_bulan = "Januari";
            }elseif($bulan_pengajuan=="02") {
                $nama_bulan = "Februari";
            }elseif($bulan_pengajuan=="03") {
                $nama_bulan = "Maret";
            }elseif($bulan_pengajuan=="04") {
                $nama_bulan = "April";
            }elseif($bulan_pengajuan=="05") {
                $nama_bulan = "Mei";
            }elseif($bulan_pengajuan=="06") {
                $nama_bulan = "Juni";
            }elseif($bulan_pengajuan=="07") {
                $nama_bulan = "Juli";
            }elseif($bulan_pengajuan=="08") {
                $nama_bulan = "Agustus";
            }elseif($bulan_pengajuan=="09") {
                $nama_bulan = "September";
            }elseif($bulan_pengajuan=="10") {
                $nama_bulan = "Oktober";
            }elseif($bulan_pengajuan=="11") {
                $nama_bulan = "Nopember";
            }else{
                $nama_bulan = "Desember";
            }
            $data_baru->bulan_pengajuan = $nama_bulan;
            $tahun_pengajuan = date("Y");
            $data_baru->tahun_pengajuan = $tahun_pengajuan;
            $data_baru->nama_kua = $data_nama_kua;
            $data_baru->nama_kecamatan = $data_nama_kecamatan;
            //simpan berkas
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('berkas_permohonan_dari_kua'),$filename);
            $data = $filename;
            $data_baru->berkas_permohonan = $data;
            //akhir simpan berkas
            //generate random string untuk nomor pendaftaran
            $randomString = Str::random(10);
            $data_baru->nomor_pendaftaran = $randomString;
            $data_baru->save();
            return redirect('dashboard_operator_kua');
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function tampil_data_berkas_permohonan_belum_selesai_oleh_operator_kua(){
        if (session()->has('LoggedOperatorKUA')){
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
                        ->where('id_operator_kua','=',$data_admin_untuk_dashboard->id)
                        ->where('status', '=', 'B')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_operator_kua.tampil_data_berkas_permohonan_belum_selesai_oleh_operator_kua',$data);
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function get_id_berkas_permohonan($id){
        $data = BerkasPermohonanDariKua::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_berkas_permohonan_dari_kua(Request $request){
        $data_perubahan = BerkasPermohonanDariKua::find($request->id);
        $data_perubahan->nik_pemohon = $request->nik_pemohon;
        $data_perubahan->nama_pemohon = $request->nama_pemohon;
        $data_perubahan->alamat_pemohon = $request->alamat_pemohon;
        $data_perubahan->jenis_permohonan = $request->jenis_permohonan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function unggah_berkas_permohonan_lagi_oleh_operator_kua(Request $request){
        $data_berkas_diperbaharui = BerkasPermohonanDariKua::find($request->id1);
        $request->validate([
            'file' => 'required|mimes:zip',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('berkas_permohonan_dari_kua'),$filename);
        $data = $filename;
        $data_berkas_diperbaharui->berkas_permohonan = $data;
        $tanggal_pengajuan = date("d/m/Y");
        $data_berkas_diperbaharui->tanggal_pengajuan = $tanggal_pengajuan;
        $data_berkas_diperbaharui->save();
        return response()->json($data_berkas_diperbaharui);
    }

    public function cetak_bukti_pendaftaran_oleh_operator_kua($id){
        if (session()->has('LoggedOperatorKUA')){
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            $nama_operator = $data_admin_untuk_dashboard->nama_operator;
            $data_berkas = BerkasPermohonanDariKua::find($id);
            $pdf = Pdf::loadView('bukti_pendaftaran_dari_kua.bukti_pendaftaran', compact('data_berkas','nama_operator'));
            return $pdf->download('bukti_pendaftaran_dari_kua.pdf');
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function tampil_data_berkas_permohonan_dari_kua_belum_selesai_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
                        ->join('operator_kuas', 'berkas_permohonan_dari_kuas.id_operator_kua', '=', 'operator_kuas.id')
                        ->join('kuas', 'operator_kuas.id_kua', '=', 'kuas.id')
                        ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
                        ->select('berkas_permohonan_dari_kuas.id',
                                'berkas_permohonan_dari_kuas.nama_pemohon',
                                'berkas_permohonan_dari_kuas.alamat_pemohon',
                                'berkas_permohonan_dari_kuas.jenis_permohonan',
                                'berkas_permohonan_dari_kuas.tanggal_pengajuan',
                                'kuas.nama_kua',
                                'berkas_permohonan_dari_kuas.berkas_permohonan',
                                'kecamatans.nama_kecamatan',
                                'berkas_permohonan_dari_kuas.status')
                        ->where('berkas_permohonan_dari_kuas.status', '=', 'B')
                        ->orderBy('berkas_permohonan_dari_kuas.id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_berkas_permohonan_dari_kua_belum_selesai_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function unggah_berkas_permohonan_dari_kua_selesai(Request $request){
        $data_berkas_diperbaharui = BerkasPermohonanDariKua::find($request->id1);
        $request->validate([
            'file' => 'required|mimes:zip,rar',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('berkas_permohonan_dari_kua_selesai'),$filename);
        $data = $filename;
        $data_berkas_diperbaharui->berkas_selesai = $data;
        $tanggal_penyelesaian = date("d/m/Y");
        $data_berkas_diperbaharui->tanggal_penyelesaian = $tanggal_penyelesaian;
        $status = "S";
        $data_berkas_diperbaharui->status = $status;
        $data_berkas_diperbaharui->save();
        return response()->json($data_berkas_diperbaharui);
    }

    public function tampil_data_berkas_permohonan_dari_kua_sudah_selesai_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_berkas_permohonan_dari_kua_sudah_selesai_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_perubahan_data_catatan_penting_untuk_kua_oleh_admin_data(Request $request){
        $data_perubahan = BerkasPermohonanDariKua::find($request->id);
        $data_perubahan->isi_canting = $request->isi_canting;
        $data_perubahan->dokumen_hasil = $request->dokumen_hasil;
        $data_perubahan->jml_kk = $request->jml_kk;
        $data_perubahan->jml_skp = $request->jml_skp;
        $data_perubahan->jml_kia = $request->jml_kia;
        $data_perubahan->jml_akta_kelahiran = $request->jml_akta_kelahiran;
        $data_perubahan->jml_akta_kematian = $request->jml_akta_kematian;
        $data_perubahan->jml_lain_lain = $request->jml_lain_lain;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function hapus_berkas_permohonan_dari_kua_oleh_admin_data(Request $request){
        $berkas_dihapus = BerkasPermohonanDariKua::find($request->id);
        $nama_berkas_dihapus = $request->berkas_permohonan;
        if(file_exists(public_path('berkas_permohonan_dari_kua/'.$nama_berkas_dihapus))){
            unlink(public_path('berkas_permohonan_dari_kua/'.$nama_berkas_dihapus));
        }
        $nama_berkas_permohonan_terbaru = "Fisik Telah Dibackup";
        $berkas_dihapus->berkas_permohonan = $nama_berkas_permohonan_terbaru;
        $berkas_dihapus->save();
    }

    public function tampil_data_berkas_permohonan_sudah_selesai_oleh_operator_kua(){
        if (session()->has('LoggedOperatorKUA')){
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
                        ->where('id_operator_kua','=',$data_admin_untuk_dashboard->id)
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_operator_kua.tampil_data_berkas_permohonan_sudah_selesai_oleh_operator_kua',$data);
        }else{
            return view('login.login_operator_kua');
        }
    }

    public function cetak_bukti_pengambilan_oleh_operator_kua($id){
        if (session()->has('LoggedOperatorKUA')){
            $data_admin_untuk_dashboard = OperatorKua::where('id','=',session('LoggedOperatorKUA'))->first();
            $nama_operator = $data_admin_untuk_dashboard->nama_operator;
            $data_berkas = BerkasPermohonanDariKua::find($id);
            $pdf = Pdf::loadView('bukti_pengambilan_dari_kua.bukti_pengambilan', compact('data_berkas','nama_operator'));
            return $pdf->download('bukti_pengambilan_dari_kua.pdf');
        }else{
            return view('login.login_operator');
        }
    }

    public function tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua(Request $request){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $request->validate([
                'bulan_pengajuan'=>'required',
                'tahun_pengajuan'=>'required',
            ],[
                'bulan_pengajuan.required'=>'Bulan tidak boleh kosong',
                'tahun_pengajuan.required'=>'Tahun tidak boleh kosong',
            ]);
            $bulan = $request->bulan_pengajuan;
            $tahun = $request->tahun_pengajuan;
            $data_tabel = DB::table('berkas_permohonan_dari_kuas')
            ->join('kuas', 'berkas_permohonan_dari_kuas.id_kua', '=', 'kuas.id')
            ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
            ->select('kuas.nama_kua',
                     'kecamatans.nama_kecamatan',
                     DB::raw('sum(jml_kk) as jumlah_kk'),
                     DB::raw('sum(jml_skp) as jumlah_skp'),
                     DB::raw('sum(jml_kia) as jumlah_kia'),
                     DB::raw('sum(jml_akta_kelahiran) as jumlah_akta_kelahiran'),
                     DB::raw('sum(jml_akta_kematian) as jumlah_akta_kematian'),
                     DB::raw('sum(jml_lain_lain) as jumlah_lain_lain'),
                     DB::raw('count(*) as jumlah'))
            ->where('berkas_permohonan_dari_kuas.bulan_pengajuan', '=', $bulan)
            ->where('berkas_permohonan_dari_kuas.tahun_pengajuan', '=', $tahun)
            ->groupBy('berkas_permohonan_dari_kuas.id_kua')
            ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua',$data,compact('bulan','tahun'));
        }else{
            return view('login.login_admin_data');
        }
    }

    public function tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua_excell(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_kua_excell',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function cetak_laporan_bulan_tahun_rekap_pengurusan_dari_kua_excell(Request $request){
        $request->validate([
            'bulan_pengajuan'=>'required',
            'tahun_pengajuan'=>'required',
        ],[
            'bulan_pengajuan.required'=>'Bulan tidak boleh kosong',
            'tahun_pengajuan.required'=>'Tahun tidak boleh kosong',
        ]);
        $request->bulan_pengajuan;
        $request->tahun_pengajuan;
        return Excel::download(new LaporanKuaBulanTahunExport($request->bulan_pengajuan,$request->tahun_pengajuan), 'Laporan_Rekap_KUA.xlsx');
    }
}
