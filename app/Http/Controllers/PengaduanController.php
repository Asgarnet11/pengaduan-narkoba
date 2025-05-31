<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000'
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'judul.required' => 'Judul pengaduan harus diisi',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'isi.required' => 'Isi pengaduan harus diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'foto.dimensions' => 'Dimensi gambar minimal 100x100px dan maksimal 4000x4000px'
        ]);

        $data = [
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'terkirim'
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9]/', '', pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('pengaduan', $fileName, 'public');
            $data['foto'] = $path;
        }

        Pengaduan::create($data);

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
