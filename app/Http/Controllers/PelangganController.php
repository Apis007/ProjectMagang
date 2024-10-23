<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Redaman;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::with('teknisi')->get();
        $teknisi = Teknisi::All();
        return view('pelanggan.index', compact('pelanggan','teknisi'),);
    }

    public function create()
{
    $teknisi = Teknisi::all(); // Ambil semua teknisi
    return view('pelanggan.create', compact('teknisi'));
}


    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'status' => 'required',
        'paket' => 'required',
        'teknisi_id' => 'required'
    ]);

    Pelanggan::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'status' => $request->status,
        'paket' => $request->paket,
        'teknisi_id' => $request->teknisi_id,
    ]);

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
}


    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return response()->json($pelanggan);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'status' => 'required',
        'paket' => 'required',
        'teknisi_id' => 'nullable|exists:teknisi,id', // Validasi teknisi_id
    ]);

    try {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());
    } catch (\Exception $e) {
        //throw $th;
        dd($e);
    }

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate.');
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
