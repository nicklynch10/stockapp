<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table="stock";

    protected $fillable = [
        'stock_ticker', 'company_name','description','sector','market_cap','current_share_price','ave_cost','share_number','date_of_purchase'
    ];
}
