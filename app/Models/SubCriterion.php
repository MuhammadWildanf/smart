<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCriterion extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_id',
        'interval',
        'nilai',
    ];

    public function criterion()
    {
        return $this->belongsTo(Criterion::class, 'criteria_id');
    }
}
