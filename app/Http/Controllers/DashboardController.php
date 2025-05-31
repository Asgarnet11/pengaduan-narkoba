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

        // Get all complaints, ordered by creation date
        $pengaduan = Pengaduan::with(['kategori', 'tanggapan', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // For statistics, only count user's own complaints
        $userPengaduan = $pengaduan->where('user_id', Auth::id());

        // Add greeting
        $hour = now()->format('H');
        if ($hour < 12) {
            $greeting = 'Pagi';
        } elseif ($hour < 17) {
            $greeting = 'Siang';
        } else {
            $greeting = 'Malam';
        }

        // Data statistik for dashboard (user's own complaints)
        $totalPengaduan = $userPengaduan->count();
        $pengaduanProses = $userPengaduan->where('status', 'diproses')->count();
        $pengaduanSelesai = $userPengaduan->where('status', 'selesai')->count();
        $pengaduanDitolak = $userPengaduan->where('status', 'ditolak')->count();

        // Recent complaints (5 latest from all users)
        $recentPengaduan = $pengaduan->take(5);

        return view('dashboard', compact(
            'pengaduan',
            'greeting',
            'totalPengaduan',
            'pengaduanProses',
            'pengaduanSelesai',
            'pengaduanDitolak',
            'recentPengaduan'
        ));
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
