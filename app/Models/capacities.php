<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capacities extends Model
{
    use HasFactory;

    protected $fillable = [
        'kapasitas_mesin',
    ];
}
