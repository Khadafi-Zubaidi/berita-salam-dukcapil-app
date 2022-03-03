<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            th {
              border: 1px solid #ffffff;
              text-align: center;
              padding: 2px;
              font-size: small;
            }
            td {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 2px;
              font-size: small;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th colspan="2">BUKTI PENDAFTARAN</th>
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
                <td>Jenis Permohonan</td>
                <td>{!! $data_berkas->jenis_permohonan !!}</td>
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
                <th colspan="2" style="border: 1px solid #dddddd;"><h2>{{ $data_berkas->nomor_pendaftaran }}</h2></th>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #dddddd;">Jangan Lupa Bawa Bukti Pendaftaran Ini Pada Saat Pengambilan Dokumen Hasil</th>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;"></td>
                <td style="text-align: center;border: 1px solid #ffffff;">Sumbawa Barat, <?php echo date("d/m/Y"); ?></td>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;"></td>
                <td style="text-color: #ffffff;;border: 1px solid #ffffff;"><h1></h1></td>
            </tr>
            <tr>
                <td style="text-align:center;border: 1px solid #ffffff;"></td>
                <td style="text-align:center;border: 1px solid #ffffff;">( {{ $nama_operator }} )</td>
            </tr>
            

        </table>
    </body>
</html>    