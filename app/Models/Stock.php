<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    use HasFactory;
    protected $table="stock";

    protected $fillable = [
        'user_id',
        'stock_ticker',
        'company_name',
        'security_name',
        'description',
        'sector',
        'market_cap',
        'current_share_price',
        'currentpriceupdate_date',
        'issuetype',
        'tags',
        'ticker_logo',
        'mutual_funds',
        'ave_cost',
        'share_number',
        'type',
        'date_of_purchase',
        'account_id',
        'security_id',
        'note',
        'dchange',
        'pchange',
        'current_total_value',
        'total_cost',
        'total_gain_loss',
        'total_long_term_gains',
    ];

    public $stockCompany;
    public $stockPrice;
    public $stocklogo;
    public $cryptoPrice;
    public $token;
    public $endpoint;


    public function stockCompanyData($ticker)
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $symbol = Http::get($endpoint . 'stable/stock/'.$ticker.'/company?token=' . $token);
        $companyData = $symbol->json();
        if($companyData != null)
        {
            $stockCompany['symbol'] = $companyData['symbol'] ? $companyData['symbol'] : '';
            $stockCompany['companyName'] = $companyData['companyName'] ? $companyData['companyName'] : '';
            $stockCompany['securityName'] = $companyData['securityName'] ? $companyData['securityName'] : '';
            $stockCompany['description'] = $companyData['description'] ? $companyData['description'] : '';
            $stockCompany['sector'] = $companyData['sector'] ? $companyData['sector'] : '';
            $stockCompany['issueType'] = $companyData['issueType'] ? $companyData['issueType'] : '';
            $stockCompany['tags'] = $companyData['tags'] ? json_encode($companyData['tags']) : '';
            return $stockCompany;
        }
    }


    public function stockPriceData($ticker)
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $current_price = Http::get($endpoint . 'stable/stock/' . $ticker . '/quote?token=' . $token);
        $priceData = $current_price->json();

        $stockPrice['marketCap'] = $priceData ? round(($priceData['marketCap']/1000), 2) : '';
        $stockPrice['latestPrice'] = $priceData ? $priceData['latestPrice'] : '';

        return $stockPrice;
    }

    public function stockLogoData($ticker)
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $logo = Http::get($endpoint . 'stable/stock/' . $ticker . '/logo?token=' . $token);
        $logo_url = $logo->json();

        $logo = $logo_url ? $logo_url['url'] : '';
        return $logo;
    }


    public function cryptoPriceData($ticker)
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);

        $current_crypto_price = Http::get($endpoint . 'stable/crypto/' . $ticker . '/quote?token=' . $token);
        $cryptoPriceData = $current_crypto_price->json();
        $cryptoPrice['latestPrice'] = $cryptoPriceData['latestPrice'] ? $cryptoPriceData['latestPrice'] : '';
        return $cryptoPrice;
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function viewupdatestock()
    {
        return $this->hasOne(ViewStockUpdate::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
