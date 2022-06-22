<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Stock;
use Illuminate\Http\Request;

class SubmitPlaidDataController extends Controller
{
    public function submitPlaidData(Request $request)
    {
        $data = $request->input();
        foreach($data as $key => $value)
        {
            $stock = Stock::find($key);
            if($stock != null)
            {
                $stock->update([
                   'stock_ticker' => $value['stock_ticker'],
                   'share_number' => $value['share_number'],
                   'ave_cost' => $value['ave_cost'],
                   'company_name' => $value['company_name'],
                   'current_share_price' => $value['current_share_price'],
                   'issuetype' => $value['issuetype'],
                ]);
            }
        }
        return redirect('account');
    }
}
