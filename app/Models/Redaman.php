<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redaman extends Model
{
    use HasFactory;

    protected $table = 'port_redaman';
    public $timestamps = false;

    protected $fillable = [
        'port', 
        'redaman', 
        'id_pelanggan', 
        'nama', 
        'alamat', 
        'paket', 
    ];

    public function model(array $row)
    {
        return new Redaman([
            'port'    => $row['port'],
            'redaman' => $row['redaman'],
            'id' => $row['id_pelanggan'],
            'nama'    => $row['nama'],
            'alamat'  => $row['alamat'],
            'paket'   => $row['paket'],
        ]);
    }
}