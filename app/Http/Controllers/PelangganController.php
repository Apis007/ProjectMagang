<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Redaman;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:255',
            'status' => 'required',
            'paket' => 'required|integer',
        ]);

        Pelanggan::create($request->all());
        return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return response()->json($pelanggan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:255',
            'status' => 'required',
            'paket' => 'required|integer',
        ]);

        $pelanggan = Pelanggan::find($id);
        $pelanggan->update($request->all());
        return redirect()->back()->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pelanggan::find($id)->delete();
        return redirect()->back()->with('success', 'Pelanggan berhasil dihapus.');
    }

    public function detail($id)
    {
    // Mengambil data pelanggan berdasarkan id
    $pelanggan = Pelanggan::findOrFail($id);

    // Mengambil data redaman berdasarkan id pelanggan
    $redaman = Redaman::where('id_pelanggan', $id)->get();

    // Jika ada data redaman, siapkan data untuk grafik
    if ($redaman->isNotEmpty()) {
        $chartData = $redaman->map(function ($item) {
            return [
                'tanggal' => $item->created_at->format('d-m-Y'),
                'redaman' => $item->redaman,
            ];
        });
    } else {
        // Jika tidak ada data redaman, kirim array kosong untuk grafik
        $chartData = [];
    }

    // Mengirim data pelanggan dan data untuk grafik ke view
    return view('pelanggan.detail', compact('pelanggan', 'chartData'));
    }

}
