<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        $pengaduan = Pengaduan::where('user_id', Auth::id())->with(['kategori', 'tanggapan'])->orderBy('created_at', 'desc')->get();

        // Tambahkan greeting
        $hour = now()->format('H');
        if ($hour < 12) {
            $greeting = 'Pagi';
        } elseif ($hour < 17) {
            $greeting = 'Siang';
        } else {
            $greeting = 'Malam';
        }

        // Data statistik untuk dashboard
        $totalPengaduan = $pengaduan->count();
        $pengaduanProses = $pengaduan->where('status', 'diproses')->count();
        $pengaduanSelesai = $pengaduan->where('status', 'selesai')->count();
        $pengaduanDitolak = $pengaduan->where('status', 'ditolak')->count();

        // Pengaduan terbaru (5 terakhir)
        $recentPengaduan = $pengaduan->take(5);

        return view('dashboard', compact('pengaduan', 'greeting', 'totalPengaduan', 'pengaduanProses', 'pengaduanSelesai', 'pengaduanDitolak', 'recentPengaduan'));
    }

    public function adminDashboard()
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'tanggapan'])->orderBy('created_at', 'desc')->get();

        $stats = [
            'total' => Pengaduan::count(),
            'terkirim' => Pengaduan::where('status', 'terkirim')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact('pengaduan', 'stats'));
    }
}
