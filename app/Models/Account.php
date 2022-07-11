<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table="account";

    protected $fillable = [
        'user_id', 'account_type','account_name','account_brokerage','commission','access_token','plaid_account_id','start_date','set_default'
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
