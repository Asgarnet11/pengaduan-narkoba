<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pengaduan = Pengaduan::with(['user', 'kategori'])->latest()->take(10)->get();
        $stats = [
            'total' => Pengaduan::count(),
            'terkirim' => Pengaduan::where('status', 'terkirim')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact('pengaduan', 'stats'));
    }

    public function index()
    {
        $pengaduan = Pengaduan::with(['user', 'kategori'])
            ->latest()
            ->paginate(10);

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'tanggapan.admin'])->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terkirim,diproses,selesai,ditolak'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui');
    }

    public function addTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string|min:10'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->tanggapan()->updateOrCreate(
            ['pengaduan_id' => $id],
            [
                'isi' => $request->isi,
                'admin_id' => Auth::id()
            ]
        );

        return back()->with('success', 'Tanggapan berhasil disimpan');
    }

    // Kategori Management
    public function kategoriIndex()
    {
        $kategoris = Kategori::withCount('pengaduan')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama',
            'deskripsi' => 'nullable|string'
        ]);

        Kategori::create($request->all());
        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama,' . $id,
            'deskripsi' => 'nullable|string'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function kategoriDestroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Cek apakah kategori masih digunakan
        if ($kategori->pengaduan()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dalam pengaduan');
        }

        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
