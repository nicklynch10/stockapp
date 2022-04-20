<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorCompare extends Model
{
    use HasFactory;


    public function SI()
    {
        return $this->belongsTo(SecInfo::class, 'SI_id');
    }

    public function factor()
    {
        return $this->belongsTo(SecInfo::class, 'factor_id');
    }
}
