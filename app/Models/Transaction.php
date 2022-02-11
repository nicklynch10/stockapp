<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table="transaction";

    protected $fillable = [
        's_id', 'type','stock','share_price','date_of_transaction'
    ];
}
