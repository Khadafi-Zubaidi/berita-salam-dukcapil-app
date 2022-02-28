<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\AkuntabilitasKinerja;
use App\Models\Carousel;
use App\Models\Berita;
use App\Models\DataAgregatSemesterDua;
use App\Models\DataAgregatSemesterSatu;
use App\Models\Formulir;
use App\Models\Inovasi;
use App\Models\Jdih;
use App\Models\ProdukLayanan;
use App\Models\ProfilKependudukan;
use App\Models\SambutanDinas;
use App\Models\Sop;
use App\Models\StandarPelayanan;
use App\Models\StrukturOrganisasi;
use App\Models\TugasPokokFungsi;
use App\Models\Tupoksi;
use App\Models\Video;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_berita = Berita::orderBy('id', 'desc')
        ->where('diperiksa_oleh_redaktur','=','S')
        ->limit(3)
        ->get();
        $data_sambutan = SambutanDinas::orderBy('id', 'desc')
        ->limit(1)
        ->get();
        $data_produk_layanan = ProdukLayanan::orderBy('id', 'asc')
        ->limit(6)
        ->get();
        $data_inovasi = Inovasi::orderBy('id', 'asc')
        ->limit(2)
        ->get();
        $data_video = Video::orderBy('id', 'asc')
        ->limit(1)
        ->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataBerita'=>$data_berita,
            'DataSambutan'=>$data_sambutan,
            'DataProdukLayanan'=>$data_produk_layanan,
            'DataInovasi'=>$data_inovasi,
            'DataVideo'=>$data_video,
        ];
        return view('beranda.beranda',$data);
    }

    public function tampil_kolom_aduan(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data = [
            'DataCarousel'=>$data_carousel,
        ];
        return view('beranda.tampil_kolom_aduan',$data);
    }


    public function get_id_berita_by_beranda3($id){
        $data = Berita::find($id);
        return response()->json($data);
    }

    public function tampil_visi_misi(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_visi_misi = VisiMisi::orderBy('id', 'desc')->limit(1)->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataVisiMisi'=>$data_visi_misi,
        ];
        return view('beranda.tampil_visi_misi',$data);
    }

    public function tampil_arsip_berita(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_berita = DB::table('beritas')
                        ->where('diperiksa_oleh_redaktur', '=', 'S')
                        ->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataBerita'=>$data_berita,
        ];
        return view('beranda.arsipberita',$data);
    }

    public function get_id_produk_layanan_by_beranda3($id){
        $data = ProdukLayanan::find($id);
        return response()->json($data);
    }

    public function tampil_arsip_produk_layanan(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_produk_layanan = ProdukLayanan::orderBy('id', 'asc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataProdukLayanan'=>$data_produk_layanan,
        ];
        return view('beranda.tampil_arsip_produk_layanan',$data);
    }

    public function tampil_arsip_inovasi(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_inovasi = Inovasi::orderBy('id', 'asc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataInovasi'=>$data_inovasi,
        ];
        return view('beranda.tampil_arsip_inovasi',$data);
    }

    public function simpan_data_baru_aduan(Request $request){
        $request->validate([
            'nik'=>'required',
            'nama'=>'required',
            'email'=>'required',
            'isi_aduan'=>'required',
        ],[
            'nik.required'=>'NIK tidak boleh kosong',
            'nama.required'=>'Nama tidak boleh kosong',
            'email.required'=>'Email tidak boleh kosong',
            'isi_aduan.required'=>'Isi Aduan tidak boleh kosong',
        ]);
        $data_baru = new Aduan();
        $data_baru->nik = $request->nik;
        $data_baru->nama = $request->nama;
        $data_baru->email = $request->email;
        $data_baru->isi_aduan = $request->isi_aduan;
        $data_baru->save();
        return redirect('tampil_terima_kasih');
    }
    
    public function tampil_terima_kasih(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data = [
            'DataCarousel'=>$data_carousel,
        ];
        return view('beranda.tampil_terima_kasih',$data);
    }

    public function tampil_arsip_jdih(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_jdih = Jdih::orderBy('id', 'asc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataJDIH'=>$data_jdih,
        ];
        return view('beranda.tampil_arsip_jdih',$data);
    }

    public function tampil_arsip_sop(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_sop = Sop::orderBy('id', 'asc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataSOP'=>$data_sop,
        ];
        return view('beranda.tampil_arsip_sop',$data);
    }

    public function tampil_arsip_formulir(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_formulir = Formulir::orderBy('id', 'asc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataFormulir'=>$data_formulir,
        ];
        return view('beranda.tampil_arsip_formulir',$data);
    }

    public function tampil_struktur_organisasi(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_struktur_organisasi = StrukturOrganisasi::orderBy('id', 'asc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataStrukturOrganisasi'=>$data_struktur_organisasi,
        ];
        return view('beranda.tampil_struktur_organisasi',$data);
    }

    public function tampil_arsip_tupoksi(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_tupoksi = TugasPokokFungsi::orderBy('id', 'desc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataTupoksi'=>$data_tupoksi,
        ];
        return view('beranda.tampil_arsip_tupoksi',$data);
    }

    public function tampil_arsip_akuntabilitas_kinerja(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_akuntabilitas_kinerja = AkuntabilitasKinerja::orderBy('id', 'desc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataAkuntabilitasKinerja'=>$data_akuntabilitas_kinerja,
        ];
        return view('beranda.tampil_arsip_akuntabilitas_kinerja',$data);
    }

    public function tampil_arsip_profil_kependudukan(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_profil_kependudukan = ProfilKependudukan::orderBy('id', 'desc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataProfilKependudukan'=>$data_profil_kependudukan,
        ];
        return view('beranda.tampil_arsip_profil_kependudukan',$data);
    }

    public function tampil_arsip_standar_pelayanan(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_standar_pelayanan = StandarPelayanan::orderBy('id', 'desc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataStandarPelayanan'=>$data_standar_pelayanan,
        ];
        return view('beranda.tampil_arsip_standar_pelayanan',$data);
    }

    public function tampil_arsip_data_agregat_kependudukan_smt_1(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_ag1 = DataAgregatSemesterSatu::orderBy('id', 'desc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataAg1'=>$data_ag1,
        ];
        return view('beranda.tampil_arsip_data_agregat_kependudukan_smt_1',$data);
    }

    public function tampil_arsip_data_agregat_kependudukan_smt_2(){
        $data_carousel = Carousel::orderBy('id', 'desc')->limit(3)->get();
        $data_ag2 = DataAgregatSemesterDua::orderBy('id', 'desc')->get();
        $data = [
            'DataCarousel'=>$data_carousel,
            'DataAg2'=>$data_ag2,
        ];
        return view('beranda.tampil_arsip_data_agregat_kependudukan_smt_2',$data);
    }

}
