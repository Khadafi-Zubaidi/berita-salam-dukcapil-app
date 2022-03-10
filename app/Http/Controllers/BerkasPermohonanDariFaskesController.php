<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use App\Models\BerkasPermohonanDariFaskes;
use App\Models\OperatorFasilitasKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanFaskesBulanTahunExport;

class BerkasPermohonanDariFaskesController extends Controller
{

    public function tambah_data_berkas_permohonan_oleh_operator_faskes(){
        if (session()->has('LoggedOperatorFasilitasKesehatan')){
            $data_admin_untuk_dashboard = OperatorFasilitasKesehatan::where('id','=',session('LoggedOperatorFasilitasKesehatan'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tambah_data_oleh_operator_faskes.tambah_data_berkas_permohonan_oleh_operator_faskes',$data);
        }else{
            return view('login.login_operator_faskes');
        }
    }

    public function simpan_data_baru_permohonan_oleh_operator_faskes(Request $request){
        if (session()->has('LoggedOperatorFasilitasKesehatan')){
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
            $data_admin_untuk_dashboard = OperatorFasilitasKesehatan::where('id','=',session('LoggedOperatorFasilitasKesehatan'))->first();
            //$id_operator = $data_admin_untuk_dashboard->id;
            //$id_desa_kul = $data_admin_untuk_dashboard->id_desa_kelurahan;
            //get nama desa
            $data_nama_faskes = DB::table('fasilitas_kesehatans')
                                ->select('fasilitas_kesehatans.nama_fasilitas_kesehatan')
                                ->where('fasilitas_kesehatans.id','=',$data_admin_untuk_dashboard->id_fasilitas_kesehatan)
                                ->get();
            //get nama kecamatan
            $data_nama_kecamatan  = DB::table('operator_fasilitas_kesehatans')
                                ->join('fasilitas_kesehatans', 'operator_fasilitas_kesehatans.id_fasilitas_kesehatan', '=', 'fasilitas_kesehatans.id')
                                ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
                                ->select('kecamatans.nama_kecamatan')
                                ->where('operator_fasilitas_kesehatans.id','=',$data_admin_untuk_dashboard->id)
                                ->get();
            $data_baru = new BerkasPermohonanDariFaskes();
            $data_baru->id_operator_fasilitas_kesehatan = $data_admin_untuk_dashboard->id;
            $data_baru->id_fasilitas_kesehatan = $data_admin_untuk_dashboard->id_fasilitas_kesehatan;
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
            $data_baru->nama_fasilitas_kesehatan = $data_nama_faskes;
            $data_baru->nama_kecamatan = $data_nama_kecamatan;
            //simpan berkas
            $extension = $request->file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->file->move(public_path('berkas_permohonan_dari_faskes'),$filename);
            $data = $filename;
            $data_baru->berkas_permohonan = $data;
            //akhir simpan berkas
            //generate random string untuk nomor pendaftaran
            $randomString = Str::random(10);
            $data_baru->nomor_pendaftaran = $randomString;
            $data_baru->save();
            return redirect('dashboard_operator_faskes');
        }else{
            return view('login.login_operator_faskes');
        }
    }

    public function tampil_data_berkas_permohonan_belum_selesai_oleh_operator_faskes(){
        if (session()->has('LoggedOperatorFasilitasKesehatan')){
            $data_admin_untuk_dashboard = OperatorFasilitasKesehatan::where('id','=',session('LoggedOperatorFasilitasKesehatan'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
                        ->where('id_operator_fasilitas_kesehatan','=',$data_admin_untuk_dashboard->id)
                        ->where('status', '=', 'B')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_operator_faskes.tampil_data_berkas_permohonan_belum_selesai_oleh_operator_faskes',$data);
        }else{
            return view('login.login_operator_faskes');
        }
    }

    public function get_id_berkas_permohonan($id){
        $data = BerkasPermohonanDariFaskes::find($id);
        return response()->json($data);
    }

    public function simpan_perubahan_data_berkas_permohonan_dari_faskes(Request $request){
        $data_perubahan = BerkasPermohonanDariFaskes::find($request->id);
        $data_perubahan->nik_pemohon = $request->nik_pemohon;
        $data_perubahan->nama_pemohon = $request->nama_pemohon;
        $data_perubahan->alamat_pemohon = $request->alamat_pemohon;
        $data_perubahan->jenis_permohonan = $request->jenis_permohonan;
        $data_perubahan->save();
        return response()->json($data_perubahan);
    }

    public function unggah_berkas_permohonan_lagi_oleh_operator_faskes(Request $request){
        $data_berkas_diperbaharui = BerkasPermohonanDariFaskes::find($request->id1);
        $request->validate([
            'file' => 'required|mimes:zip',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('berkas_permohonan_dari_faskes'),$filename);
        $data = $filename;
        $data_berkas_diperbaharui->berkas_permohonan = $data;
        $tanggal_pengajuan = date("d/m/Y");
        $data_berkas_diperbaharui->tanggal_pengajuan = $tanggal_pengajuan;
        $data_berkas_diperbaharui->save();
        return response()->json($data_berkas_diperbaharui);
    }

    public function cetak_bukti_pendaftaran_oleh_operator_faskes($id){
        if (session()->has('LoggedOperatorFasilitasKesehatan')){
            $data_admin_untuk_dashboard = OperatorFasilitasKesehatan::where('id','=',session('LoggedOperatorFasilitasKesehatan'))->first();
            $nama_operator = $data_admin_untuk_dashboard->nama_operator;
            $data_berkas = BerkasPermohonanDariFaskes::find($id);
            $pdf = Pdf::loadView('bukti_pendaftaran_dari_faskes.bukti_pendaftaran', compact('data_berkas','nama_operator'));
            return $pdf->download('bukti_pendaftaran_dari_faskes.pdf');
        }else{
            return view('login.login_operator_faskes');
        }
    }

    public function tampil_data_berkas_permohonan_dari_faskes_belum_selesai_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
                        ->join('operator_fasilitas_kesehatans', 'berkas_permohonan_dari_faskes.id_operator_fasilitas_kesehatan', '=', 'operator_fasilitas_kesehatans.id')
                        ->join('fasilitas_kesehatans', 'operator_fasilitas_kesehatans.id_fasilitas_kesehatan', '=', 'fasilitas_kesehatans.id')
                        ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
                        ->select('berkas_permohonan_dari_faskes.id',
                                'berkas_permohonan_dari_faskes.nama_pemohon',
                                'berkas_permohonan_dari_faskes.alamat_pemohon',
                                'berkas_permohonan_dari_faskes.jenis_permohonan',
                                'berkas_permohonan_dari_faskes.tanggal_pengajuan',
                                'fasilitas_kesehatans.nama_fasilitas_kesehatan',
                                'berkas_permohonan_dari_faskes.berkas_permohonan',
                                'kecamatans.nama_kecamatan',
                                'berkas_permohonan_dari_faskes.status')
                        ->where('berkas_permohonan_dari_faskes.status', '=', 'B')
                        ->orderBy('berkas_permohonan_dari_faskes.id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_berkas_permohonan_dari_faskes_belum_selesai_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function unggah_berkas_permohonan_dari_faskes_selesai(Request $request){
        $data_berkas_diperbaharui = BerkasPermohonanDariFaskes::find($request->id1);
        $request->validate([
            'file' => 'required|mimes:zip,rar',
        ]);
        $extension = $request->file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $request->file->move(public_path('berkas_permohonan_dari_faskes_selesai'),$filename);
        $data = $filename;
        $data_berkas_diperbaharui->berkas_selesai = $data;
        $tanggal_penyelesaian = date("d/m/Y");
        $data_berkas_diperbaharui->tanggal_penyelesaian = $tanggal_penyelesaian;
        $status = "S";
        $data_berkas_diperbaharui->status = $status;
        $data_berkas_diperbaharui->save();
        return response()->json($data_berkas_diperbaharui);
    }

    public function tampil_data_berkas_permohonan_dari_faskes_sudah_selesai_oleh_admin_data(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_data_berkas_permohonan_dari_faskes_sudah_selesai_oleh_admin_data',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function simpan_perubahan_data_catatan_penting_untuk_faskes_oleh_admin_data(Request $request){
        $data_perubahan = BerkasPermohonanDariFaskes::find($request->id);
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

    public function hapus_berkas_permohonan_dari_faskes_oleh_admin_data(Request $request){
        $berkas_dihapus = BerkasPermohonanDariFaskes::find($request->id);
        $nama_berkas_dihapus = $request->berkas_permohonan;
        if(file_exists(public_path('berkas_permohonan_dari_faskes/'.$nama_berkas_dihapus))){
            unlink(public_path('berkas_permohonan_dari_faskes/'.$nama_berkas_dihapus));
        }
        $nama_berkas_permohonan_terbaru = "Fisik Telah Dibackup";
        $berkas_dihapus->berkas_permohonan = $nama_berkas_permohonan_terbaru;
        $berkas_dihapus->save();
    }

    public function tampil_data_berkas_permohonan_sudah_selesai_oleh_operator_faskes(){
        if (session()->has('LoggedOperatorFasilitasKesehatan')){
            $data_admin_untuk_dashboard = OperatorFasilitasKesehatan::where('id','=',session('LoggedOperatorFasilitasKesehatan'))->first();
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
                        ->where('id_operator_fasilitas_kesehatan','=',$data_admin_untuk_dashboard->id)
                        ->where('status', '=', 'S')
                        ->orderBy('id', 'desc')
                        ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_operator_faskes.tampil_data_berkas_permohonan_sudah_selesai_oleh_operator_faskes',$data);
        }else{
            return view('login.login_operator_faskes');
        }
    }

    public function cetak_bukti_pengambilan_oleh_operator_faskes($id){
        if (session()->has('LoggedOperatorFasilitasKesehatan')){
            $data_admin_untuk_dashboard = OperatorFasilitasKesehatan::where('id','=',session('LoggedOperatorFasilitasKesehatan'))->first();
            $nama_operator = $data_admin_untuk_dashboard->nama_operator;
            $data_berkas = BerkasPermohonanDariFaskes::find($id);
            $pdf = Pdf::loadView('bukti_pengambilan_dari_faskes.bukti_pengambilan', compact('data_berkas','nama_operator'));
            return $pdf->download('bukti_pengambilan_dari_faskes.pdf');
        }else{
            return view('login.login_operator');
        }
    }

    public function tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_faskes(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_faskes',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function cetak_laporan_bulan_tahun_rekap_permohonan_dari_faskes(Request $request){
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
            $data_tabel = DB::table('berkas_permohonan_dari_faskes')
            ->join('fasilitas_kesehatans', 'berkas_permohonan_dari_faskes.id_fasilitas_kesehatan', '=', 'fasilitas_kesehatans.id')
            ->join('kecamatans', 'fasilitas_kesehatans.id_kecamatan', '=', 'kecamatans.id')
            ->select('fasilitas_kesehatans.nama_fasilitas_kesehatan',
                     'kecamatans.nama_kecamatan',
                     DB::raw('sum(jml_kk) as jumlah_kk'),
                     DB::raw('sum(jml_skp) as jumlah_skp'),
                     DB::raw('sum(jml_kia) as jumlah_kia'),
                     DB::raw('sum(jml_akta_kelahiran) as jumlah_akta_kelahiran'),
                     DB::raw('sum(jml_akta_kematian) as jumlah_akta_kematian'),
                     DB::raw('sum(jml_lain_lain) as jumlah_lain_lain'),
                     DB::raw('count(*) as jumlah'))
            ->where('berkas_permohonan_dari_faskes.bulan_pengajuan', '=', $bulan)
            ->where('berkas_permohonan_dari_faskes.tahun_pengajuan', '=', $tahun)
            ->groupBy('berkas_permohonan_dari_faskes.id_fasilitas_kesehatan')
            ->get();
            $data = [
                'DataTabel'=>$data_tabel,
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.cetak_laporan_bulan_tahun_rekap_permohonan_dari_faskes',$data,compact('bulan','tahun'));
        }else{
            return view('login.login_admin_data');
        }
    }

    public function tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_faskes_excell(){
        if (session()->has('LoggedAdminData')){
            $data_admin_untuk_dashboard = AdminData::where('id','=',session('LoggedAdminData'))->first();
            $data = [
                'LoggedUserInfo'=>$data_admin_untuk_dashboard,
            ];
            return view('tampil_data_oleh_admin_data.tampil_form_cetak_laporan_bulan_tahun_rekap_permohonan_dari_faskes_excell',$data);
        }else{
            return view('login.login_admin_data');
        }
    }

    public function cetak_laporan_bulan_tahun_rekap_pengurusan_dari_faskes_excell(Request $request){
        $request->validate([
            'bulan_pengajuan'=>'required',
            'tahun_pengajuan'=>'required',
        ],[
            'bulan_pengajuan.required'=>'Bulan tidak boleh kosong',
            'tahun_pengajuan.required'=>'Tahun tidak boleh kosong',
        ]);
        $request->bulan_pengajuan;
        $request->tahun_pengajuan;
        return Excel::download(new LaporanFaskesBulanTahunExport($request->bulan_pengajuan,$request->tahun_pengajuan), 'Laporan_Rekap_Fasilitas_Kesehatan.xlsx');
    }

}
