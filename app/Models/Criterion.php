<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'kode',
        'criteria',
        'jenis',
    ];

    public function subcriteria()
    {
        return $this->hasMany(SubCriterion::class, 'criteria_id');
    }
}
