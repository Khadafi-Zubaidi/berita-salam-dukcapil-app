<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanDesaBulanTahunExport implements FromCollection, WithHeadings 
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
        $data_export = DB::table('berkas_pengurusans')
            ->join('desa_kelurahans', 'berkas_pengurusans.id_desa_kelurahan', '=', 'desa_kelurahans.id')
            ->join('kecamatans', 'desa_kelurahans.id_kecamatan', '=', 'kecamatans.id')
            ->select('desa_kelurahans.nama_desa_kelurahan',
                     'kecamatans.nama_kecamatan',
                     DB::raw('count(*) as jumlah'),
                     DB::raw('sum(jml_kk) as jumlah_kk'),
                     DB::raw('sum(jml_skp) as jumlah_skp'),
                     DB::raw('sum(jml_kia) as jumlah_kia'),
                     DB::raw('sum(jml_akta_kelahiran) as jumlah_akta_kelahiran'),
                     DB::raw('sum(jml_akta_kematian) as jumlah_akta_kematian'),
                     DB::raw('sum(jml_lain_lain) as jumlah_lain_lain'),
                     )
            ->where('berkas_pengurusans.bulan_pengajuan', '=', $this->bulan)
            ->where('berkas_pengurusans.tahun_pengajuan', '=', $this->tahun)
            ->groupBy('berkas_pengurusans.id_desa_kelurahan')
            ->get();
        return $data_export;
    }

    public function headings(): array{
        return [
            'Desa/Kelurahan',
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
