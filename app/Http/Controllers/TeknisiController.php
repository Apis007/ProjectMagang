<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisi = Teknisi::all();
        return view('teknisi.index', compact('teknisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:20',
            'no_hp' => 'required|max:13',
        ]);

        Teknisi::create($request->all());
        return redirect()->back()->with('success', 'Teknisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $teknisi = Teknisi::find($id);
        return response()->json($teknisi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:20',
            'no_hp' => 'required|max:13',
        ]);

        $teknisi = Teknisi::find($id);
        $teknisi->update($request->all());
        return redirect()->back()->with('success', 'Teknisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Teknisi::find($id)->delete();
        return redirect()->back()->with('success', 'Teknisi berhasil dihapus.');
    }
}
