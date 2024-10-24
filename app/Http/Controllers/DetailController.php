<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        
        // Pastikan pelanggan ada
        if (!$pelanggan) {
            return redirect()->route('pelanggan.index')->with('error', 'Pelanggan tidak ditemukan.');
        }

        return view('pelanggan.show', compact('pelanggan')); // Ganti 'pelanggan.show' dengan path view yang benar
    }
}
