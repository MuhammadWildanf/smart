<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function history()
    {
        return $this->belongsTo(History::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
