<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan Baru Diterima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .content-table td:first-child {
            font-weight: bold;
            width: 150px;
        }

        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        a {
            color: #4f46e5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">🚨 Laporan Pengaduan Baru</div>
        <p>Halo Admin,</p>
        <p>Sebuah laporan pengaduan baru telah masuk ke dalam sistem dan memerlukan perhatian Anda. Berikut adalah
            rinciannya:</p>

        <table class="content-table">
            <tr>
                <td>Judul Laporan:</td>
                <td>{{ $pengaduan->judul }}</td>
            </tr>
            <tr>
                <td>Nama Pelapor:</td>
                <td>{{ $pengaduan->user->name }}</td>
            </tr>
            @if ($pengaduan->user->telp)
                <tr>
                    <td>Hubungi Pelapor:</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaduan->user->telp) }}" target="_blank">
                            <b>Chat di WhatsApp ({{ $pengaduan->user->telp }})</b>
                        </a>
                    </td>
                </tr>
            @endif
            <tr>
                <td>Kategori:</td>
                <td>{{ $pengaduan->kategori->nama ?? 'Tidak dikategorikan' }}</td>
            </tr>
            <tr>
                <td>Tanggal Lapor:</td>
                <td>{{ $pengaduan->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @if ($pengaduan->latitude && $pengaduan->longitude)
                <tr>
                    <td>Lokasi TKP:</td>
                    <td>
                        {{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}
                        <br>
                        <a href="http://googleusercontent.com/maps.google.com/6{{ $pengaduan->latitude }},{{ $pengaduan->longitude }}"
                            target="_blank">
                            <b>Buka di Google Maps</b>
                        </a>
                    </td>
                </tr>
            @endif
        </table>

        <div style="text-align: center;">
            <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="button">Lihat Detail di Dasbor</a>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh sistem. Mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
