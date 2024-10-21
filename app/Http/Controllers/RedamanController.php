<?php

namespace App\Http\Controllers;

use App\Models\Redaman;
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
            // Menghapus baris header
            array_shift($rows);
            $importedCount = 0;

            foreach ($rows as $row) {
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
                    continue; // Skip this row if validation fails
                }

                Redaman::create($data);
                $importedCount++;
            }

            return redirect()->back()->with('success', "Berhasil mengimpor $importedCount data redaman.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
