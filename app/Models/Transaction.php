<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;

class Transaction extends Model
{
    use HasFactory;
    protected $table="transaction";

    protected $fillable = [
        'stock_id', 'type','stock','share_price','date_of_transaction'
    ];
}
