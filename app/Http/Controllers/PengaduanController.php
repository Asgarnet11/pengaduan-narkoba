<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\NotifikasiPengaduanBaru;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with(['kategori', 'tanggapan', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('pengaduan.create', compact('kategoris'));
    }

    // app/Http/Controllers/PengaduanController.php

    public function store(Request $request)
    {
        // 1. VALIDASI DATA MASUKAN
        // ========================
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|min:10|max:255',
            'isi' => 'required|string|min:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        // 2. PERSIAPAN DATA UNTUK DISIMPAN
        // =================================
        $validatedData['user_id'] = Auth::id();
        $validatedData['status'] = 'terkirim';

        // 3. PROSES UPLOAD FOTO (JIKA ADA)
        // =================================
        if ($request->hasFile('foto')) {
            // Simpan file di storage/app/public/pengaduan
            $path = $request->file('foto')->store('pengaduan', 'public');
            $validatedData['foto'] = $path;
        }

        // 4. BUAT PENGADUAN DI DATABASE
        // ==============================
        $pengaduanBaru = Pengaduan::create($validatedData);

        // 5. KIRIM NOTIFIKASI EMAIL KE ADMIN
        // ===================================
        try {
            // Ganti dengan email admin yang sebenarnya
            Mail::to('afatwahyudi@gmail.com')->send(new NotifikasiPengaduanBaru($pengaduanBaru));
        } catch (\Exception $e) {
            // Jika email gagal, catat error di log tanpa menghentikan aplikasi
            Log::error('Gagal mengirim email notifikasi: ' . $e->getMessage());
        }

        // 6. KIRIM NOTIFIKASI WHATSAPP KE ADMIN (VERSI FLEKSIBEL)
        // ========================================================
        try {
            $receiverNumber = '+6282293560277'; // <-- GANTI DENGAN NOMOR WA ADMIN ANDA
            $googleMapsLink = "https://www.google.com/maps/search/?api=1&query={$pengaduanBaru->latitude},{$pengaduanBaru->longitude}";

            // Susun pesan yang detail
            $message  = "🚨 *Laporan Pengaduan Baru Diterima!*\n\n";
            $message .= "*Judul:*\n" . $pengaduanBaru->judul . "\n\n";
            $message .= "*Pelapor:*\n" . $pengaduanBaru->user->name . "\n\n";
            $message .= "*Kategori:*\n" . $pengaduanBaru->kategori->nama . "\n\n";
            $message .= "*Isi Laporan:*\n" . Str::limit($pengaduanBaru->isi, 150) . "\n\n";
            $message .= "*Lokasi TKP:*\n" . $googleMapsLink . "\n\n";
            $message .= "Lihat detail lengkap di dasbor:\n";
            $message .= route('admin.pengaduan.show', $pengaduanBaru->id);

            // Siapkan data untuk dikirim ke Twilio
            $twilioData = [
                'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'),
                'body' => $message,
            ];

            // Cerdas: Kirim gambar HANYA jika di hosting (production) dan ada foto
            if (app()->environment('production') && $pengaduanBaru->foto) {
                // asset() akan membuat URL publik yang benar sesuai APP_URL di hosting
                $twilioData['mediaUrl'] = [asset('storage/' . $pengaduanBaru->foto)];
            }

            // Kirim pesan via Twilio
            $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
            $client->messages->create('whatsapp:' . $receiverNumber, $twilioData);
        } catch (\Exception $e) {
            // Jika WhatsApp gagal, catat error di log tanpa menghentikan aplikasi
            Log::error('Gagal mengirim notifikasi WhatsApp: ' . $e->getMessage());
        }

        // 7. ARAHKAN PENGGUNA KEMBALI
        // =============================
        return redirect()->route('dashboard')->with('success', 'Pengaduan berhasil dikirim! Petugas akan segera menindaklanjuti.');
    }


    public function show($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'tanggapan.admin'])->findOrFail($id);

        return view('pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terkirim,diproses,selesai,ditolak'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    public function addTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|min:10|max:1000'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // Buat data tanggapan
        $tanggapanData = [
            'isi_tanggapan' => $request->isi_tanggapan,
            'user_id' => Auth::id(),
            'tanggal' => now()
        ];

        // Jika user adalah admin, tambahkan admin_id
        if (Auth::user()->isAdmin()) {
            $tanggapanData['admin_id'] = Auth::id();
            $tanggapanData['user_id'] = null;
        }

        $pengaduan->tanggapan()->create($tanggapanData);

        return back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }
}
