<?php

namespace App\Http\Livewire;

use App\Models\SecCompare;
use App\Models\Stock;
use App\Models\StockTicker;
use App\Models\Transaction;
use Capsule\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Account as Accounts;

class Account extends Component
{
    public $isOpen = 0;
    public $isOpenPlaid = 0;
    public $isLoading = 0;
    public $isLoadingVal = 0;
    public $user_id;
    public $account_type;
    public $account_name;
    public $account_brokerage;
    public $commission;
    public $account_id;
    public $deleteid;
    public $set_default;
    public $allData;
    public $data;
    public $deleteaccount=0;
    public $token;
    public $account;
    public $accountName;
    public $beforeDate;
    public $message;
    public $accounts;
    public $InsertedID = [];
    public $NoMissingData = [];
    protected $listeners = ['getToken' => 'render', 'getAccessToken' => 'getAccessToken'];

    public function render()
    {
        $client_id = env('PLAID_CLIENT_ID');
        $secret = env('PLAID_SECRET');
        $client_name = env('PLAID_CLIENT_NAME');
        $plaid_url = env('PLAID_URL');
        if($client_id && $secret && $client_name)
        {
            $url = "https://".$plaid_url."/link/token/create";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $data = '{
            "client_id": "'.$client_id.'",
            "secret": "'.$secret.'",
            "client_name": "'.$client_name.'",
            "country_codes": ["US"],
            "language": "en",
            "user": {
                "client_user_id": "unique_user_id"
                },
            "products": ["investments"]}';
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            $data = json_decode($resp);
            $this->token = $data->link_token;
        }
        $this->account=Accounts::where('user_id', Auth::user()->id)->orderBy('account.created_at', 'DESC')->get();
        return view('livewire.account');
    }


    public function getAccessToken($public_token)
    {
        $client_id = env('PLAID_CLIENT_ID');
        $secret = env('PLAID_SECRET');
        $plaid_url = env('PLAID_URL');

        $url = "https://".$plaid_url."/item/public_token/exchange";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = '{
            "client_id": "'.$client_id.'",
            "secret": "'.$secret.'",
            "public_token": "'.$public_token.'"}';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);

        $data = json_decode($resp);
        $this->access = $data->access_token;
        $this->getInvestment($this->access);
    }

    public function getInvestment($access_token)
    {
        $client_id = env('PLAID_CLIENT_ID');
        $secret = env('PLAID_SECRET');
        $plaid_url = env('PLAID_URL');

//        $account = Accounts::where(['access_token' => $access_token, 'user_id' => Auth::user()->id])->first();
//        if(isset($account)) {
//            $beforeDate = $account['start_date'];
//        } else {
            $beforeDate = date('Y-01-01', strtotime('-1 year'));
//        }

        $url = "https://".$plaid_url."/investments/transactions/get";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = '{
            "client_id": "'.$client_id.'",
            "secret": "'.$secret.'",
            "access_token": "'.$access_token.'",
            "start_date": "'.$beforeDate.'",
            "end_date":"'.date('Y-m-d').'"}';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        $data = json_decode($resp);
        $this->addInvestments($data, $access_token);
    }

    public function addInvestments($data, $access_token)
    {
        $response = $data;
        foreach ($response->accounts as $ac)
        {
            if($ac->type == "investment") {
                $accountName = Accounts::where(['account_name' => $ac->name,'user_id' => Auth::user()->id])->first();
                $beforeDate = date('Y-01-01', strtotime('-1 year'));
                if(!isset($accountName)) {
                    Accounts::Create([
                        'user_id' => Auth::user()->id,
                        'account_type' => $ac->type,
                        'account_name' => $ac->name,
                        'account_brokerage' => 'Not assigned',
                        'access_token' => $access_token,
                        'start_date' => $beforeDate,
                        'set_default' => 0,
                        'plaid_account_id' => $ac->account_id,
                    ]);
                } else {
                    $accountName->update([
                        'plaid_account_id' => $ac->account_id,
                        'start_date' => date('Y-m-d'),
                    ]);
                }
            }
        }

        foreach ($response->securities as $sec)
        {
            foreach ($response->investment_transactions as $inv)
            {
                if($inv->type == 'buy')
                {
                    if($inv->security_id == $sec->security_id && $sec->ticker_symbol != null)
                    {
                        $getAccountId = Accounts::where(['plaid_account_id' => $inv->account_id, 'user_id' => Auth::user()->id])->first();
                        $checkStock = Stock::where(['stock_ticker' => $sec->ticker_symbol , 'share_number' => $inv->quantity, 'security_id' => $inv->security_id, 'date_of_purchase' => $inv->date,'user_id' => Auth::user()->id])->first();
                        if(!isset($checkStock)) {
                            $key = env('IEX_CLOUD_KEY', null);
                            $endpoint = env('IEX_CLOUD_ENDPOINT', null);
                            $current_price = Http::get($endpoint . 'stable/stock/' . $sec->ticker_symbol . '/quote?token=' . $key);
                            $price = $current_price->json();

                            if($price == null) {
                                $current_price = Http::get($endpoint . 'stable/crypto/' . $sec->ticker_symbol . '/quote?token=' . $key);
                                $price = $current_price->json();
                                $currebtPrice = $price ? $price['latestPrice'] : 0;
                                $companyname = $price ? $price['companyName'] : null ;
                            } else {
                                $currebtPrice = $price ? $price['latestPrice'] : 0;
                                $companyname = $price ? $price['companyName'] : null;
                            }

                            $insertid = Stock::Create([
                                'user_id' => Auth::user()->id,
                                'stock_ticker' => $sec->ticker_symbol,
                                'ave_cost' => $inv->price != null ? $inv->price : 0,
                                'share_number' => $inv->quantity,
                                'date_of_purchase' => $inv->date,
                                'account_id' => $getAccountId->id,
                                'security_id' => $inv->security_id,
                                'current_share_price' => $currebtPrice ? $currebtPrice : 0,
                                'company_name' => $companyname ? $companyname : null,
                                'issuetype' => $sec->type == 'etf' ? 'et' : null,
                            ]);
                            $lastInsertedID = $insertid->id;
                            if($sec->ticker_symbol == null || $inv->price == null || $inv->quantity == null || $currebtPrice == null || $companyname == null || $sec->type == null) {
                                array_push($this->InsertedID, $lastInsertedID);
                            }
                            else {
                                array_push($this->NoMissingData, $lastInsertedID);
                            }

                            Transaction::Create([
                                'stock_id' => $lastInsertedID,
                                'type' => 0,
                                'ticker_name' => $sec->ticker_symbol,
                                'stock' => $inv->quantity,
                                'share_price' => $inv->price != null ? $inv->price : 0,
                                'user_id' => Auth::user()->id,
                                'date_of_transaction' => $inv->date,
                                'plaid_investment_transaction_id' => $inv->security_id,
                            ]);
                        }
                    }
                }
            }
        }

        foreach ($response->investment_transactions as $inv)
        {
            if($inv->type == 'sell')
            {
                foreach ($response->securities as $sec)
                {
                    if($inv->security_id == $sec->security_id && $sec->ticker_symbol != null)
                    {
                        $transactionCheck = Transaction::where(['type' => 1,'plaid_investment_transaction_id' => $inv->security_id, 'user_id' => Auth::user()->id,'stock' => $inv->quantity])->first();
                        $stockCheck = Stock::where(['security_id' => $inv->security_id,'user_id' => Auth::user()->id])->first();
                        if($stockCheck != null && $transactionCheck == null)
                        {
                            if($stockCheck->id) {
                                Transaction::Create([
                                    'stock_id' => $stockCheck->id,
                                    'type' => 1,
                                    'ticker_name' => $stockCheck->stock_ticker,
                                    'stock' => abs($inv->quantity),
                                    'share_price' => $inv->price!=null ? $inv->price : 0,
                                    'user_id' => Auth::user()->id,
                                    'date_of_transaction' => $inv->date,
                                    'plaid_investment_transaction_id' => $inv->security_id,
                                ]);

                                $current_stock = Stock::select('share_number')->where('id', $stockCheck->id)->first();
                                $final_stock = $current_stock->share_number - abs($inv->quantity);
                                $record = Stock::find($stockCheck->id);
                                $record->update([
                                    'share_number' => $final_stock,
                                ]);
                            }
                        }
                    }
                }
            }
        }
        if(count($this->InsertedID)>0)
        {
            $this->isloading();
            $this->openPlaidDataModal($this->InsertedID);
        }
        elseif (count($this->NoMissingData)>0) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Added all the transaction in the selected account',
            ]);
        }
        else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'No more holdings found in selected account',
            ]);
        }
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->resetValidation('account_type');
        $this->resetValidation('account_name');
        $this->resetValidation('account_brokerage');
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->account_type = '';
        $this->account_name = '';
        $this->account_brokerage = '';
        $this->commission = '';
        $this->account_id = '';
    }

    public function store()
    {
        $this->validate([
            'account_name' => 'required',
            'account_type' => 'required',
            'account_brokerage' => 'required',
        ]);
        Accounts::updateOrCreate(['id' => $this->account_id], [
            'user_id' =>Auth::user()->id,
            'account_type' => $this->account_type,
            'account_name' => $this->account_name,
            'account_brokerage' => $this->account_brokerage,
//            'commission' => $this->commission,
        ]);

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $this->account_id ? 'Account Update Successful' : 'New Account Created Successfully',
        ]);
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $stock = Accounts::findOrFail($id);
        $this->account_id = $id;
        $this->account_type = $stock->account_type;
        $this->account_name = $stock->account_name;
        $this->account_brokerage = $stock->account_brokerage;
//        $this->commission = $stock->commission;
        $this->openModal();
    }

    public function delete($id)
    {
        $data = Accounts::where('id', $id)->first();
        if ($data['set_default'] == 1) {
            $allData = Accounts::where('user_id', Auth::user()->id)->where('id', '!=', $id)->first();
            if ($allData) {
                $allData->update([
                    'set_default' => 1,
                ]);
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'message' => '<p class="text-red-700">Account Delete Successfully</p> <br>'.$allData['account_name'].' Account Set As Default.'
                ]);
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'message' => 'Account Deleted Successfully.<br> Please make a new account if you wish to continue.'
                ]);
            }
            Accounts::find($id)->delete();
        } else {
            Accounts::find($id)->delete();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Account Deleted Successfully.'
            ]);
        }
        $this->closedeleteaccount();
        $this->closeModal();
    }

    public function deleteaccount($id)
    {
        $this->deleteid = $id;
        $this->deleteaccount = true;
    }

    public function closedeleteaccount()
    {
        $this->deleteaccount = false;
    }

    public function set_default($set_default)
    {
        Accounts::where('user_id', '=', Auth::user()->id)->update(['set_default' => 0]);
        $result = Accounts::find($set_default);
        $result->update([
            'set_default' => 1,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Account Set As Default'
        ]);
    }

    public $inputs = [];
    public function openPlaidDataModal($InsertedID)
    {
        $inputs = [];
        foreach($InsertedID as $a)
        {
            $stock = Stock::where('id', $a)->first();
            if(!($stock['stock_ticker'] && $stock['share_number'] && $stock['ave_cost'] && $stock['company_name'] &&
                $stock['current_share_price'] && $stock['issuetype'] ))
            {
                $data = [
                    'id' => $stock['id'],
                    'stock_ticker' => $stock['stock_ticker'],
                    'share_number' => $stock['share_number'],
                    'ave_cost' => $stock['ave_cost'],
                    'company_name' => $stock['company_name'],
                    'current_share_price' => $stock['current_share_price'],
                    'issuetype' => $stock['issuetype'],
                ];
                array_push($this->inputs ,$data);
            }
        }
    }

    public function openplaidmodal()
    {
        $this->isLoading = false;
        $this->isOpenPlaid = true;
    }

    public function isloading()
    {
        $this->isLoading = true;
    }

    public function closeIsLoading()
    {
        $this->isLoading = false;
    }

    public function isClosePlaid()
    {
        $this->isOpenPlaid = false;
    }
}
