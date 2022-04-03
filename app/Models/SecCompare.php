<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecCompare extends Model
{
    use HasFactory;


    public function SI1()
    {
        return $this->belongsTo(SecInfo::class, 'SI1_id');
    }

    public function SI2()
    {
        return $this->belongsTo(SecInfo::class, 'SI2_id');
    }
}
