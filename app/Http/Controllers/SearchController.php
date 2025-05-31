<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type', 'all');

        if (empty($query) || strlen($query) < 3) {
            return response()->json([]);
        }

        $pengaduanQuery = Pengaduan::with(['user', 'kategori'])
            ->where(function($q) use ($query, $type) {
                if ($type === 'all' || $type === 'judul') {
                    $q->orWhere('judul', 'like', "%{$query}%");
                }
                if ($type === 'all' || $type === 'isi') {
                    $q->orWhere('isi', 'like', "%{$query}%");
                }
                if ($type === 'all' || $type === 'kategori') {
                    $q->orWhereHas('kategori', function($q) use ($query) {
                        $q->where('nama', 'like', "%{$query}%");
                    });
                }
            });

        // If user is not admin, only show their own complaints
        if (!Auth::user()->isAdmin()) {
            $pengaduanQuery->where('user_id', Auth::id());
        }

        $results = $pengaduanQuery->limit(5)->get()
            ->map(function($pengaduan) {
                return [
                    'id' => $pengaduan->id,
                    'judul' => $pengaduan->judul,
                    'kategori' => $pengaduan->kategori->nama,
                    'status' => $pengaduan->status,
                    'url' => route('pengaduan.show', $pengaduan->id),
                    'created_at' => $pengaduan->created_at->format('d M Y')
                ];
            });

        return response()->json($results);
    }
}
