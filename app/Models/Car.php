<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga_id',
        'warna_id',
        'kapasitas_mesin_id',
        'seat_id',
        'image_url',
    ];


    public function harga()
    {
        return $this->belongsTo(prices::class, 'harga_id');
    }

    public function warna()
    {
        return $this->belongsTo(colors::class, 'warna_id');
    }

    public function seat()
    {
        return $this->belongsTo(seats::class, 'seat_id');
    }

    public function kapasitasMesin()
    {
        return $this->belongsTo(capacities::class, 'kapasitas_mesin_id');
    }
}
