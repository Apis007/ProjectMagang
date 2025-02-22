<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redaman extends Model
{
    use HasFactory;

    protected $table = 'port_redaman';
    public $timestamps = true;
    
    protected $fillable = [
        'port',
        'redaman',
        'id_pelanggan',
        'nama',
        'alamat',
        'paket',
        
    ];

    // Tambahkan ini untuk melihat query yang dijalankan
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            \Log::info("Creating new redaman:", $model->toArray());
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}