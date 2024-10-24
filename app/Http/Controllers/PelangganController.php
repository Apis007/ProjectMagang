<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Redaman;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
    // Log ID pelanggan yang sedang diakses
    \Log::info("Mengakses detail pelanggan ID: " . $id);

    // Mengambil data pelanggan
    $pelanggan = Pelanggan::findOrFail($id);
    \Log::info("Data Pelanggan:", $pelanggan->toArray());

    // Mengambil dan log data redaman mentah
    $redaman = Redaman::where('id_pelanggan', $id)
        ->orderBy('created_at', 'asc')
        ->get();
    \Log::info("Jumlah data redaman: " . $redaman->count());
    \Log::info("Query redaman:", [
        'sql' => Redaman::where('id_pelanggan', $id)->toSql(),
        'bindings' => Redaman::where('id_pelanggan', $id)->getBindings()
    ]);

    // Mengambil data teknisi
    $teknisi = Teknisi::find($pelanggan->teknisi_id);

    // Siapkan data chart dengan debugging
    if ($redaman->isNotEmpty()) {
        $chartData = $redaman->map(function ($item) {
            $data = [
                'tanggal' => date('d-m-Y', strtotime($item->created_at)),
                'redaman' => (float)$item->redaman,
            ];
            \Log::info("Processing redaman item:", $data);
            return $data;
        });
    } else {
        $chartData = [];
        \Log::info("Tidak ada data redaman untuk pelanggan dengan ID: " . $id);
    }

    return view('pelanggan.detail', compact('pelanggan', 'teknisi', 'chartData'));
}
}
