<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seats extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_seat',
    ];
}
