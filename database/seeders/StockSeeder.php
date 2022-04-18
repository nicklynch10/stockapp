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
            'last_name' => 'User',
            'email' => "demo@gmail.com",
            'password'=>Hash::make('z'),
        ]);


//        $n=User::create([
//            'name' => 'Nick Lynch',
//            'first_name' => 'Nick',
//            'last_name' => "Lynch",
//            'email' => "nick@taxghost.com",
//            'password'=>bcrypt('z'),
//        ]);


        // @ajay this needs to be for all users... account for 1 user should not show up for other users.
        $acc=Account::create([
            'user_id'=>$user->id,
            'account_type'=> 'Individual Brokerage Account',
            'account_name'=>'Taxable Account',
            'account_brokerage'=>'Not assigned',
            'commission'=>0,
            'set_default'=>1,
        ]);

        $stock=['UBS' , 'IBM' , 'TM' , 'HDB' , 'ZTS' , 'NLIT' , 'PLNT' , 'FORTY' , 'AMZN' , 'TKR' , 'EEMS' , 'VBR' , 'AVDV' , 'SCHC' , 'PSFE' ,
            'EPHE' , 'UBX' , 'ETY' , 'MNTS' , 'XTAP' , 'RDHL' , 'AIR' , 'BHP' , 'EFT' , 'GOGL' , 'HRB' , 'IGEB' , 'IPDN' , 'MMC' , 'PBUS' ,
            'ECNS' , 'VB' , 'GCIG' , 'SPY' , 'INDA' , 'IXC' , 'BBC' , 'RING' , 'VWO' , 'VTV' , 'BABA' , 'CCOR' , 'ERJ' , 'KTF' , 'OLED',
            'HERO' , 'VOE' , 'EFV' , 'VDE' , 'MJ' , 'VFMO' , 'EWJ' , 'GM' , 'BTC' , 'LABU' , 'JETS' , 'PCB' , 'CPNG' , 'JBI' , 'LIFE' ,
            'GOOG' , 'AJX' , 'AM' , 'GEM' , 'AMAT' , 'BAND' , 'TSLA' , 'PBR' , 'REX' , 'GGAL' , 'WNDY' , 'HMN' , 'IT' , 'MARK' , 'NDP',
            'BCAT' , 'MLPR' , 'GH' , 'IMPL' , 'ZEST' , 'WIRE' , 'BB' , 'CHT' , 'DAUG' , 'EPRF' , 'FLN' , 'GROW' , 'INCO' , 'LCUT' , 'MOR',
            'RELL' , 'RESD' , 'SQFT' , 'TISI' , 'UXIN' , 'VCR' , 'WINT' , 'NKE' , 'HDG' , 'AZEK'];


        // @ajay please clean this up and separate this into different factories
        foreach ($stock as $st) {
            $token = env('IEX_CLOUD_KEY', null);
            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
            $symbol = Http::get($endpoint . 'stable/stock/'.$st->ticker.'/company?token=' . $token);
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
            $tags=$company ? json_encode($company['tags']) : '';
            $security_name=$company ? $company['securityName'] : '';
            $current_price = Http::get($endpoint . 'stable/stock/' . $st->ticker . '/quote?token=' . $token);
            $price = $current_price->json();
            $current_share_price = $price ? $price['latestPrice'] : '';
            $market_cap = $price ? round(($price['marketCap']/1000000), 2) : '';
            $start = strtotime('2020-01-01');
            $end = strtotime(date('Y-m-d'));
            $timestamp = mt_rand($start, $end);
            $r=date('Y-m-d', $timestamp);
            $diff=date_diff(date_create(Carbon::createFromTimestamp(strtotime($r))->format('Y-m-d')), date_create(date('Y-m-d')));
            $share_number=random_int(10, 30);
            $ave_cost=$current_share_price+1;
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
                'ave_cost' => $ave_cost,
                'share_number' => $share_number,
                'date_of_purchase' => $r,
                'note'=>'',
                'account_id'=>$acc->id,
                'dchange'=>$current_share_price-$ave_cost,
                'pchange'=>(($current_share_price/$ave_cost)-1)*100,
                'current_total_value'=>($current_share_price*$share_number),
                'total_cost'=>($ave_cost*$share_number),
                'total_gain_loss'=>($current_share_price*$share_number)-($ave_cost*$share_number),
                'total_long_term_gains'=>$diff->format("%a")>366 ? "Long / " .$diff->format("%d")." Days held" : "Short / ".$diff->format("%d")." Days held",
            ]);


        foreach ($stock as $st)
        {
            $result=Stock::factory()->addStock($user->id , $acc->id , $st)->create();
            Transaction::create([
                'stock_id' => $result->id,
                'type' => 0,
                'ticker_name' => $result->stock_ticker,
                'stock' => $result->share_number,
                'share_price' => $result->ave_cost,
                'user_id' => $result->user_id,
                'date_of_transaction' => $result->date_of_purchase,
            ]);
        }
    }
}
