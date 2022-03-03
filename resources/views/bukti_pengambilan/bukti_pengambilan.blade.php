<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
              font-family: arial, sans-serif;
              font-size: 8px;
              border-collapse: collapse;
              width: 100%;
            }
            th {
              border: 1px solid #ffffff;
              text-align: center;
              padding: 1px;
              font-size: small;
            }
            td {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 1px;
              font-size: small;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th colspan="2">BUKTI PENGAMBILAN DOKUMEN</th>
            </tr>
            <tr>
                <th colspan="2">PENGURUSAN DOKUMEN KEPENDUDUKAN</th>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #dddddd;" >DATA PEMOHON</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $data_berkas->nama_pemohon }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>{{ $data_berkas->nik_pemohon }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $data_berkas->alamat_pemohon }}</td>
            </tr>
            <tr>
                <td>Tanggal Pengajuan</td>
                <td>{{ $data_berkas->tanggal_pengajuan }}</td>
            </tr>
            <tr>
                <td>Desa / Kelurahan</td>
                <td>{{ str_replace(array( '[', ']','{','}',':','"','nama_desa_kelurahan'), '', $data_berkas->nama_desa_kelurahan) }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>{{ str_replace(array( '[', ']','{','}',':','"','nama_kecamatan'), '', $data_berkas->nama_kecamatan) }}</td>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #dddddd;">Nomor Pendaftaran</th>
            </tr>
            <tr>
                <th colspan="2" style="border: 1px solid #dddddd;"><h3>{{ $data_berkas->nomor_pendaftaran }}</h3></th>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #dddddd;">Dokumen Hasil</th>
            </tr>
            <tr>
                <td>Nama Dokumen</td>
                <td>Checklist</td>
            </tr>
            <tr>
                <td>{!! $data_berkas->dokumen_hasil !!}</td>
                <td></td>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #dddddd;">Catatan Penting</th>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #dddddd;">{{ $data_berkas->isi_canting }}</th>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;"><h4></h4></td>
                <td style="text-color: #ffffff;;border: 1px solid #ffffff;"><h4></h4></td>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;">Diterima Oleh,</td>
                <td style="text-align: center;border: 1px solid #ffffff;">Sumbawa Barat, <?php echo date("d/m/Y"); ?></td>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;"><h1></h1></td>
                <td style="text-color: #ffffff;;border: 1px solid #ffffff;"><h1></h1></td>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;">( {{ $data_berkas->nama_pemohon }} )</td>
                <td style="text-align:center;border: 1px solid #ffffff;">( {{ $nama_operator }} )</td>
            </tr>
        </table>
        
        
    </body>
</html>    