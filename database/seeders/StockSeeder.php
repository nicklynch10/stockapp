<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Stock;
use App\Models\StockTicker;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name' => 'Demo user',
            'first_name' => 'Demo',
            'last_name' => "User",
            'email' => "demo@gmail.com",
            'password'=>Hash::make('demo@2022'),
        ]);

        $acc=Account::create([
            'user_id'=>$user->id,
            'account_type'=> 'Individual Brokerage Account',
            'account_name'=>'Taxable Account',
            'account_brokerage'=>'Not assigned',
            'commission'=>0,
            'set_default'=>1,
        ]);

        $stock=StockTicker::inRandomOrder()->limit(100)->get();
        foreach($stock as $st)
        {
            $token = 'pk_367c9e2f397648309da77c1a14e17ff6';
            $endpoint = 'https://cloud.iexapis.com/';
            $symbol = Http::get($endpoint . 'stable/stock/'.$st->ticker.'/company?token=' . $token);
            $company = $symbol->json();
            $description = $company ? $company['description'] : '';
            $sector = $company ? $company['sector'] : '';
            if(isset($company['issueType']))
            {
                if($company['issueType']=='et')
                {
                    $issuetype="ETF";
                }
                elseif ($company['issueType']=='ad')
                {
                    $issuetype="ADR";
                }
                elseif ($company['issueType']=='cs')
                {
                    $issuetype="Common Stock";
                }
                else
                {
                    $issuetype=$company['issueType'];
                }
            }
            $tags=$company?json_encode($company['tags']):'';
            $security_name=$company?$company['securityName']:'';
            $current_price = Http::get($endpoint . 'stable/stock/' . $st->ticker . '/quote?token=' . $token);
            $price = $current_price->json();
            $current_share_price = $price ? $price['latestPrice'] : '';
            $market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
            $start = strtotime('2020-01-01');
            $end = strtotime(date('Y-m-d'));
            $timestamp = mt_rand($start, $end);
            $r=date('Y-m-d',$timestamp);
            $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($r))->format('Y-m-d')),date_create(date('Y-m-d')));
            $share_number=random_int(10,30);
            $stockId=Stock::create([
                'user_id'=>$user->id,
                'stock_ticker'=>$st->ticker,
                'company_name' => $st->ticker_company,
                'description' => $description,
                'sector' => $sector,
                'security_name' => $security_name,
                'market_cap' => $market_cap,
                'current_share_price' => $current_share_price,
                'issuetype' => $issuetype,
                'tags' => $tags,
                'ave_cost' => ($current_share_price+1),
                'share_number' => $share_number,
                'date_of_purchase' => $r,
                'note'=>'',
                'account_id'=>$acc->id,
                'dchange'=>($current_share_price-($current_share_price+1))*$share_number,
                'pchange'=>($current_share_price/($current_share_price+1))-1,
                'current_total_value'=>($current_share_price*$share_number),
                'total_cost'=>(($current_share_price+1)*$share_number),
                'total_gain_loss'=>0,
                'total_long_term_gains'=>$diff->format("%a")>366?"Long / " .$diff->format("%d")." Days held" :"Short / ".$diff->format("%d")." Days held",
            ]);

            Transaction::create([
                'stock_id'=>$stockId->id,
                'type'=>0,
                'ticker_name'=>$st->ticker,
                'stock'=>$share_number,
                'share_price'=>($current_share_price+1),
                'user_id'=>$user->id,
                'date_of_transaction'=>$r,
            ]);
        }
    }
}
