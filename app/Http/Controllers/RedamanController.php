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
            $processedPelangganIds = [];

            foreach ($rows as $row) {
                if (empty($row[0]) && empty($row[1]) && empty($row[2])) {
                    continue; // Lewati baris kosong
                }

                // Menggunakan Carbon untuk memanipulasi tanggal
                $currentDate = Carbon::now();

                $data = [
                    'port'    => $row[0],
                    'redaman' => $row[1],
                    'id_pelanggan' => $row[2],
                    'nama'    => $row[3],
                    'alamat'  => $row[4],
                    'paket'   => $row[5],
                    'created_at' => $currentDate, // Menggunakan Carbon untuk mendapatkan tanggal saat ini
                    'updated_at' => $currentDate
                ];

                // Validasi dan simpan data redaman
                Redaman::create($data);
                $importedCount++;

                // Periksa apakah pelanggan sudah ada
                if (!in_array($data['id_pelanggan'], $processedPelangganIds)) {
                    $pelanggan = Pelanggan::find($data['id_pelanggan']);
                    if ($pelanggan) {
                        $pelanggan->update([
                            'nama' => $data['nama'],
                            'alamat' => $data['alamat'],
                            'paket' => $data['paket'],
                        ]);
                    } else {
                        Pelanggan::create([
                            'id' => $data['id_pelanggan'],
                            'nama' => $data['nama'],
                            'alamat' => $data['alamat'],
                            'paket' => $data['paket'],
                        ]);
                    }
                    $processedPelangganIds[] = $data['id_pelanggan'];
                }
            }

            return redirect()->back()->with('success', "Berhasil mengimpor $importedCount data redaman.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
