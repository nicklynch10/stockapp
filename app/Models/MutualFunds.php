<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutualFunds extends Model
{
    use HasFactory;

    protected $table="mutualfunds";
    protected $fillable = [
        'symbol', 'name'
    ];
}
