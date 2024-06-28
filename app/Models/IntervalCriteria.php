<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntervalCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['criteria_id', 'range', 'value'];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
