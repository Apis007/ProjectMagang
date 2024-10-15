<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
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
            'nama' => 'required|max:20',
            'alamat' => 'required|max:13',
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
            'nama' => 'required|max:20',
            'alamat' => 'required|max:13',
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
}
