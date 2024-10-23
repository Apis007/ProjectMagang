<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    public $timestamps = true;

    protected $fillable = [
        'nama', 
        'alamat', 
        'status', 
        'paket',
        'teknisi_id',
    ];

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, 'teknisi_id');
    }
}
