<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;

    protected $table = 'teknisi';
    public $timestamps = false;

    protected $fillable = [
        'nama', 
        'no_hp', 
    ];
    
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class);
    }
}