<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;
    protected $table="cryptocurrency";
    protected $fillable = [
        'crypto_symbol', 'crypto_name'
    ];
}
