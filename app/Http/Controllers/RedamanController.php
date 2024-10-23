<?php

namespace App\Http\Controllers;

use App\Models\Redaman;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Validator;
use Carbon\Carbon;


class RedamanController extends Controller
{
    public function index()
    {
        $redaman = Redaman::all();
        return view('redaman.index', compact('redaman'));
        dd($redaman);
    }

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    try {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        array_shift($rows); // Menghapus baris header
        $importedCount = 0;
        $skippedCount = 0;

        foreach ($rows as $row) {
            // Cek apakah baris kosong
            if (empty($row[0]) && empty($row[1]) && empty($row[2]) && empty($row[3]) && empty($row[4]) && empty($row[5])) {
                \Log::info("Baris kosong dilewati.");
                $skippedCount++;
                continue; // Lewati baris kosong
            }

            // Logging data yang sedang diproses
            \Log::info("Mengimpor data: ", $row);

            $data = [
                'port'    => $row[0],
                'redaman' => $row[1],
                'id_pelanggan' => $row[2],
                'nama'    => $row[3],
                'alamat'  => $row[4],
                'paket'   => $row[5],
            ];

            $validator = Validator::make($data, [
                'port' => 'required|string|max:100',
                'redaman' => 'required|string|max:100',
                'id_pelanggan' => 'required|integer',
                'nama'    => 'required|string|max:100',
                'alamat'  => 'required|string|max:255',
                'paket'   => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                \Log::info("Validasi gagal untuk data: ", $data);
                $skippedCount++;
                continue; // Lewati data jika validasi gagal
            }

            Redaman::create($data);
            $importedCount++;

            // Update atau buat pelanggan baru
            $pelanggan = Pelanggan::find($data['id_pelanggan']);
            if ($pelanggan) {
                \Log::info("Mengupdate pelanggan ID: " . $data['id_pelanggan']);
                $pelanggan->update([
                    'nama' => $data['nama'],
                    'alamat' => $data['alamat'],
                    'paket' => $data['paket'],
                ]);
            } else {
                \Log::info("Membuat pelanggan baru dengan ID: " . $data['id_pelanggan']);
                Pelanggan::create([
                    'id' => $data['id_pelanggan'],
                    'nama' => $data['nama'],
                    'alamat' => $data['alamat'],
                    'paket' => $data['paket'],
                ]);
            }
        }

        \Log::info("Jumlah data yang berhasil diimpor: $importedCount");
        \Log::info("Jumlah data yang dilewati karena validasi atau kosong: $skippedCount");
        return redirect()->back()->with('success', "Berhasil mengimpor $importedCount data redaman. $skippedCount data dilewati karena kosong atau validasi gagal.");
    } catch (\Exception $e) {
        \Log::error('Terjadi kesalahan: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}
