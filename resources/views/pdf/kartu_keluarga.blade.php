<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Keluarga - {{ $keluarga->nomor_kk }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; margin: 0; padding: 0;}
        .container { padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 18pt; margin: 0; }
        .header h2 { font-size: 14pt; margin: 5px 0; }
        .content { width: 100%; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 2px 5px; vertical-align: top;}
        .main-table { width: 100%; border-collapse: collapse; }
        .main-table th, .main-table td { border: 1px solid black; padding: 5px; text-align: center; font-size: 9pt; }
        .main-table th { background-color: #f2f2f2; }
        .main-table td { vertical-align: middle; }
        .footer { margin-top: 30px; width: 100%; }
        .footer td { vertical-align: top; text-align: center; width: 33.33%; font-size: 10pt; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1><strong>DATA IKHWAN JABAR</strong></h1>
        <h2>No. {{ $keluarga->nomor_kk }}</h2>
    </div>

    <table class="info-table">
        <tr>
            <td style="width: 15%;">Nama Kepala</td>
            <td style="width: 2%;">:</td>
            <td style="width: 48%;">{{ strtoupper($keluarga->nama_kepala_keluarga) }}</td>
            <td style="width: 15%;">Kecamatan</td>
            <td style="width: 2%;">:</td>
            <td style="width: 18%;">{{ strtoupper($keluarga->kecamatan) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ strtoupper($keluarga->alamat) }}</td>
            <td>Kabupaten/Kota</td>
            <td>:</td>
            <td>{{ strtoupper($keluarga->kabupaten_kota) }}</td>
        </tr>
        <tr>
            <td>RT/RW</td>
            <td>:</td>
            <td>{{ $keluarga->rt }} / {{ $keluarga->rw }}</td>
            <td>Kode Pos</td>
            <td>:</td>
            <td>{{ $keluarga->kode_pos }}</td>
        </tr>
        <tr>
            <td>Desa/Kelurahan</td>
            <td>:</td>
            <td>{{ strtoupper($keluarga->desa_kelurahan) }}</td>
            <td>Provinsi</td>
            <td>:</td>
            <td>{{ strtoupper($keluarga->provinsi) }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Lengkap</th>
                <th rowspan="2">NIK</th>
                <th rowspan="2">Jenis Kelamin</th>
                <th rowspan="2">Tempat Lahir</th>
                <th rowspan="2">Tanggal Lahir</th>
                <th rowspan="2">Agama</th>
                <th rowspan="2">Pendidikan</th>
                <th colspan="2">Data Tambahan</th>
            </tr>
            <tr>
                <th>Jenis Pekerjaan</th>
                <th>Gol. Darah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keluarga->anggota as $index => $anggota)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="text-align: left;">{{ strtoupper($anggota->nama_lengkap) }}</td>
                <td>{{ $anggota->nik }}</td>
                <td>{{ $anggota->jenis_kelamin }}</td>
                <td>{{ strtoupper($anggota->tempat_lahir) }}</td>
                <td>{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ strtoupper($anggota->agama) }}</td>
                <td>{{ strtoupper($anggota->pendidikan) }}</td>
                <td>{{ strtoupper($anggota->jenis_pekerjaan) }}</td>
                <td>{{ $anggota->golongan_darah ?: '-' }}</td>
            </tr>
            @endforeach
            @for ($i = $keluarga->anggota->count(); $i < 10; $i++)
            <tr>
                <td> </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            @endfor
        </tbody>
    </table>
    
    <br>

    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th colspan="2">Status Perkawinan</th>
                <th rowspan="2">Status Hubungan Dalam Keluarga</th>
                <th rowspan="2">Kewarganegaraan</th>
                <th colspan="2">Nama Orang Tua</th>
            </tr>
            <tr>
                <th>Status</th>
                <th>Tgl Perkawinan</th>
                <th>Ayah</th>
                <th>Ibu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keluarga->anggota as $index => $anggota)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ strtoupper($anggota->status_perkawinan) }}</td>
                <td>{{ $anggota->tanggal_perkawinan ? \Carbon\Carbon::parse($anggota->tanggal_perkawinan)->format('d-m-Y') : '-' }}</td>
                <td>{{ strtoupper($anggota->status_hubungan_dalam_keluarga) }}</td>
                <td>{{ strtoupper($anggota->kewarganegaraan) }}</td>
                <td style="text-align: left;">{{ strtoupper($anggota->nama_ayah) }}</td>
                <td style="text-align: left;">{{ strtoupper($anggota->nama_ibu) }}</td>
            </tr>
            @endforeach
            @for ($i = $keluarga->anggota->count(); $i < 10; $i++)
            <tr>
                <td> </td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            @endfor
        </tbody>
    </table>

    {{-- <table class="footer">
        <tr>
            <td></td>
            <td></td>
            <td>
                {{ $keluarga->kabupaten_kota }}, {{ \Carbon\Carbon::parse($keluarga->tanggal_dikeluarkan)->isoFormat('D MMMM Y') }}<br>
                KEPALA DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL
                <br><br><br><br>
                <strong><u>(NAMA KEPALA DINAS)</u></strong><br>
                NIP. (NIP KEPALA DINAS)
            </td>
        </tr>
    </table> --}}
</div>
</body>
</html>