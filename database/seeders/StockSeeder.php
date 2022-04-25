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
            'name' => 'Pal',
            'first_name' => 'Pal',
            'last_name' => 'Priti',
            'email' => "pal@gmail.com",
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
