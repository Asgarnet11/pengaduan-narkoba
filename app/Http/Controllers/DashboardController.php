<?php

// Pastikan namespace controller Anda benar
namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller // Ganti nama class jika perlu
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            // Arahkan admin ke dasbor admin, ini sudah benar
            return redirect()->route('admin.dashboard');
        }

        // --- MULAI PERBAIKAN LOGIKA DI SINI ---

        $userId = Auth::id();

        $userPengaduanQuery = Pengaduan::where('user_id', $userId);

        $totalPengaduan = (clone $userPengaduanQuery)->count();
        $pengaduanProses = (clone $userPengaduanQuery)->where('status', 'diproses')->count();
        $pengaduanSelesai = (clone $userPengaduanQuery)->where('status', 'selesai')->count();
        $pengaduanDitolak = (clone $userPengaduanQuery)->where('status', 'ditolak')->count();

        $recentPengaduan = (clone $userPengaduanQuery)
            ->with(['kategori', 'user', 'tanggapan'])
            ->latest() // Shortcut untuk orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $hour = now()->setTimezone('Asia/Makassar')->hour;
        if ($hour < 12) {
            $greeting = 'Pagi';
        } elseif ($hour < 15) {
            $greeting = 'Siang';
        } elseif ($hour < 18) {
            $greeting = 'Sore';
        } else {
            $greeting = 'Malam';
        }

        // 6. Kirim data yang sudah benar dan efisien ke view
        return view('dashboard', compact(
            'greeting',
            'totalPengaduan',
            'pengaduanProses',
            'pengaduanSelesai',
            'pengaduanDitolak',
            'recentPengaduan'
        ));
    }
}
