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
        $pengaduan = Pengaduan::where('user_id', Auth::id())->with(['kategori', 'tanggapan'])->orderBy('created_at', 'desc')->get();
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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
            $path = $foto->store('pengaduan', 'public');
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
            'status' => 'required|in:terkirim,diproses,selesai'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    public function addTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string'
        ]);

        Tanggapan::create([
            'pengaduan_id' => $id,
            'admin_id' => Auth::id(),
            'isi_tanggapan' => $request->isi_tanggapan
        ]);

        return back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }
}
