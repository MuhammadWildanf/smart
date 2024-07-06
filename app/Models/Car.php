<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'code',
        'name',
        'price',
        'color',
        'available_seat',
        'capacity_machine'
    ];
}
