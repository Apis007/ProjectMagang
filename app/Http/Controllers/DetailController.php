<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan; // Gantilah dengan model yang sesuai
use Illuminate\Http\Request;

class PelangganController extends Controller
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
