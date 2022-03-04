<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTicker extends Model
{
    use HasFactory;

    protected $table="stockticker";
    protected $fillable = [
        'ticker', 'ticker_company'
    ];
}
