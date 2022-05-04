<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model=Stock::class;

    public function definition()
    {
        return [

        ];
    }


    public function addStock($userId , $accountId , $ticker)
    {
        $token = env('IEX_CLOUD_KEY', null);
        $endpoint = env('IEX_CLOUD_ENDPOINT', null);
        $symbol = Http::get($endpoint . 'stable/stock/' . $ticker . '/company?token=' . $token);
        $company = $symbol->json();
        $description = $company ? $company['description'] : '';
        $sector = $company ? $company['sector'] : '';

        if (isset($company['issueType'])) {
            if ($company['issueType']=='et') {
                $issuetype="ETF";
            } elseif ($company['issueType']=='ad') {
                $issuetype="ADR";
            } elseif ($company['issueType']=='cs') {
                $issuetype="Common Stock";
            } else {
                $issuetype=$company['issueType'];
            }
        }

        $tags = $company ? json_encode($company['tags']) : '';
        $security_name = $company ? $company['securityName'] : '';

        $current_price = Http::get($endpoint . 'stable/stock/' . $ticker . '/quote?token=' . $token);
        $price = $current_price->json();

        $current_share_price = $price ? $price['latestPrice'] : '';
        $market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
        $start = strtotime('2020-01-01');
        $end = strtotime(date('Y-m-d'));
        $timestamp = mt_rand($start, $end);
        $r = date('Y-m-d', $timestamp);
        $diff = date_diff(date_create(Carbon::createFromTimestamp(strtotime($r))->format('Y-m-d')), date_create(date('Y-m-d')));
        $share_number = random_int(10, 30);
        $ave_cost = $current_share_price + 1;

        $logo = Http::get($endpoint . 'stable/stock/' . $ticker . '/logo?token=' . $token);
        $logo_url = $logo->json();
        $tickerLogo = $logo_url ? $logo_url['url'] : '';

        return $this->state([
            'user_id' => $userId,
            'stock_ticker' => $ticker,
            'company_name' => $company['companyName'],
            'description' => $description,
            'sector' => $sector,
            'security_name' => $security_name,
            'market_cap' => $market_cap,
            'current_share_price' => $current_share_price,
            'issuetype' => $issuetype,
            'tags' => $tags,
            'ave_cost' => $ave_cost,
            'share_number' => $share_number,
            'date_of_purchase' => $r,
            'note' => '',
            'account_id' => $accountId,
            'dchange' => $current_share_price-$ave_cost,
            'pchange' => (($current_share_price/$ave_cost)-1)*100,
            'current_total_value' => ($current_share_price*$share_number),
            'total_cost' => ($ave_cost*$share_number),
            'total_gain_loss' => ($current_share_price*$share_number)-($ave_cost*$share_number),
            'total_long_term_gains' => $diff->format("%a")>366 ? "Long / " .$diff->format("%d")." Days held" : "Short / ".$diff->format("%d")." Days held",
            'ticker_logo' => $tickerLogo,
        ]);
    }
}
