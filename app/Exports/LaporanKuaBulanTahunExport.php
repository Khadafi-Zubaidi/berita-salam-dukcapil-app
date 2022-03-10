<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanKuaBulanTahunExport implements FromCollection, WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $bulan,$tahun;

    function __construct($bulan_pengajuan,$tahun_pengajuan){
        $this->bulan = $bulan_pengajuan;
        $this->tahun = $tahun_pengajuan;
    }

    public function collection()
    {
        $data_export = DB::table('berkas_permohonan_dari_kuas')
            ->join('kuas', 'berkas_permohonan_dari_kuas.id_kua', '=', 'kuas.id')
            ->join('kecamatans', 'kuas.id_kecamatan', '=', 'kecamatans.id')
            ->select('kuas.nama_kua',
                     'kecamatans.nama_kecamatan',
                     DB::raw('count(*) as jumlah'),
                     DB::raw('sum(jml_kk) as jumlah_kk'),
                     DB::raw('sum(jml_skp) as jumlah_skp'),
                     DB::raw('sum(jml_kia) as jumlah_kia'),
                     DB::raw('sum(jml_akta_kelahiran) as jumlah_akta_kelahiran'),
                     DB::raw('sum(jml_akta_kematian) as jumlah_akta_kematian'),
                     DB::raw('sum(jml_lain_lain) as jumlah_lain_lain'),
                     )
            ->where('berkas_permohonan_dari_kuas.bulan_pengajuan', '=', $this->bulan)
            ->where('berkas_permohonan_dari_kuas.tahun_pengajuan', '=', $this->tahun)
            ->groupBy('berkas_permohonan_dari_kuas.id_kua')
            ->get();
        return $data_export;
    }

    public function headings(): array{
        return [
            'KUA',
            'Kecamatan',
            'Jml.Pengurusan',
            'Jml.KK',
            'Jml.SKP',
            'Jml.KIA',
            'Jml.Akta Kelahiran',
            'Jml.Akta Kematian',
            'Jml.Lain-Lain',
        ];
    }
}
