<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query) || strlen($query) < 3) {
            return response()->json([]);
        }

        $pengaduanQuery = Pengaduan::with(['user', 'kategori'])
            ->where(function($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                    ->orWhere('isi', 'like', "%{$query}%")
                    ->orWhereHas('kategori', function($q) use ($query) {
                        $q->where('nama', 'like', "%{$query}%");
                    })
                    ->orWhere('status', 'like', "%{$query}%")
                    ->orWhereHas('user', function($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    });
            })
            ->orderByRaw("
                CASE
                    WHEN judul LIKE ? THEN 1
                    WHEN isi LIKE ? THEN 2
                    ELSE 3
                END
            ", ["%{$query}%", "%{$query}%"])
            ->orderBy('created_at', 'desc');

        $results = $pengaduanQuery->limit(8)->get()
            ->map(function($pengaduan) {
                return [
                    'id' => $pengaduan->id,
                    'judul' => $pengaduan->judul,
                    'isi' => Str::limit($pengaduan->isi, 100),
                    'kategori' => $pengaduan->kategori->nama,
                    'status' => $pengaduan->status,
                    'pelapor' => $pengaduan->user->name,
                    'is_own' => $pengaduan->user_id === Auth::id(),
                    'url' => route('pengaduan.show', $pengaduan->id),
                    'created_at' => $pengaduan->created_at->format('d M Y'),
                    'photo_url' => $pengaduan->user->getProfilePhotoUrl()
                ];
            });

        return response()->json($results);
    }
}
