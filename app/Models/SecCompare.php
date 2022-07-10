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

    public function compare_stats()
    {
        //ajay include logic here
        // $this->SI1 or $this->SI2 will give you access to the SecInfo models containing stats
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        // continue code here

        // returns back this SecCompare at the end
        $this->total_weights = 0; // CHANGE this to the total of all the matches
        //$this->save(); //saves to DB before returning

        return $this;
    }
}
