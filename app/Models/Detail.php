<?php

namespace App\Http\Controllers;

use App\Models\Models;
use App\Models\Redaman;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($id)
    {
        // Mengambil data pelanggan berdasarkan id
        $pelanggan = Pelanggan::findOrFail($id);

        // Mengambil data redaman pelanggan
        $redaman = Redaman::where('id_pelanggan', $id)->orderBy('created_at', 'asc')->get();

        // Siapkan data untuk grafik
        $chartData = [];
        foreach ($redaman as $item) {
            $chartData[] = [
                'tanggal' => $item->created_at->format('Y-m-d'), // Format tanggal
                'redaman' => $item->redaman
            ];
        }

        // Kirim data pelanggan dan data grafik ke view
        return view('pelanggan.detail', compact('pelanggan', 'chartData'));
    }
}
