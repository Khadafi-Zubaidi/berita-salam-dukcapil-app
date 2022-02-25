<!DOCTYPE html>
<html>
    <body>
        <div align="center">
            <h3>BUKTI PENDAFTARAN</h3>
            <h3>PENGURUSAN DOKUMEN KEPENDUDUKAN</h3>
            <hr>
            <h4>DATA PEMOHON</h4>
            <hr>
        </div>
        <pre>
            Nama Pemohon        : {{ $data_berkas->nama_pemohon }}
            Tanggal Pengajuan   : {{ $data_berkas->tanggal_pengajuan }}
            Jenis Permohonan    : {{ $data_berkas->jenis_permohonan }}
        </pre>
        <hr>
        <div align="center">
            Nomor Pendaftaran<br>
            <h1>{{ $data_berkas->nomor_pendaftaran }}</h1>
        </div>
    </body>
</html>    