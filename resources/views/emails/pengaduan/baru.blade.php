@component('mail::message')
    # Laporan Pengaduan Baru Telah Diterima

    Halo Admin,

    Sebuah laporan pengaduan baru telah masuk ke dalam sistem. Mohon untuk segera ditindaklanjuti.

    **Detail Laporan:**
    - **Judul:** {{ $pengaduan->judul }}
    - **Pelapor:** {{ $pengaduan->user->name }}
    - **Kategori:** {{ $pengaduan->kategori->nama }}
    - **Tanggal Lapor:** {{ $pengaduan->created_at->format('d M Y, H:i') }}

    @component('mail::button', ['url' => route('admin.pengaduan.show', $pengaduan->id), 'color' => 'primary'])
        Lihat Detail Pengaduan
    @endcomponent

    Terima kasih,<br>
    Sistem {{ config('app.name') }}
@endcomponent
