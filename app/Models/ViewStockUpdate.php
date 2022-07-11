<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStockUpdate extends Model
{
    use HasFactory;
    protected $table="view_stock_update";

    protected $fillable = [
        'stock_id','stock_ticker','dchange','pchange','current_total_value','total_cost','total_gain_loss'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
