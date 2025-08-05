<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\NotifikasiPengaduanBaru;
use Illuminate\Support\Facades\Mail;


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
        // Bagian validasi Anda sudah benar, tidak perlu diubah
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|min:10|max:255',
            'isi' => 'required|string|min:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ], [
            // ... (semua pesan validasi Anda) ...
            'latitude.required' => 'Lokasi pada peta wajib ditentukan.',
            'longitude.required' => 'Lokasi pada peta wajib ditentukan.'
        ]);

        // Bagian persiapan data Anda sudah benar
        $data = [
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'terkirim',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ];

        // Logika upload foto Anda juga sudah benar
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9]/', '', pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('pengaduan', $fileName, 'public');
            $data['foto'] = $path;
        }

        // --- PERUBAHAN URUTAN DIMULAI DARI SINI ---

        // 1. BUAT PENGADUAN DULU dan simpan hasilnya ke variabel
        $pengaduanBaru = Pengaduan::create($data);

        // 2. BARU KIRIM EMAIL menggunakan variabel yang sudah dibuat
        try {
            Mail::to('afatwahyudi@gmail.com')->send(new NotifikasiPengaduanBaru($pengaduanBaru));
        } catch (\Exception $e) {
            // Log::error($e->getMessage());
            // Jika email gagal, proses tetap lanjut.
            // Anda bisa menambahkan Log::error($e->getMessage()); di sini untuk debugging jika perlu.
        }

        return redirect('/dashboard')->with('success', 'Pengaduan berhasil dikirim!');
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
