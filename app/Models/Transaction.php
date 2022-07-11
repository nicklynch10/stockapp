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
        'stock_id','ticker_name','type','stock','share_price','user_id','date_of_transaction','plaid_investment_transaction_id',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
