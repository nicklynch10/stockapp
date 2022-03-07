<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Stock extends Model
{
    use HasFactory;
    protected $table="stock";

    protected $fillable = [
        'user_id','stock_ticker','company_name','description','sector','market_cap','current_share_price','issuetype','tags','ave_cost','share_number','date_of_purchase','account_id','note','dchange','pchange',
        'current_total_value','total_cost','total_gain_loss','total_long_term_gains',
    ];

}
