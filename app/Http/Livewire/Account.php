<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\StockTicker;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Account as Accounts;

class Account extends Component
{
    public $isOpen = 0;
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
    protected $listeners = ['getToken' => 'render', 'getAccessToken' => 'getAccessToken'];

    public function render()
    {
        $client_id = env('PLAID_CLIENT_ID');
        $secret = env('PLAID_SECRET');
        $client_name = env('PLAID_CLIENT_NAME');
        $url = "https://sandbox.plaid.com/link/token/create";
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
        $this->account=Accounts::where('user_id', Auth::user()->id)->orderBy('account.created_at', 'DESC')->get();
        return view('livewire.account');
    }


    public function getAccessToken($public_token)
    {
        $client_id = env('PLAID_CLIENT_ID');
        $secret = env('PLAID_SECRET');

        $url = "https://sandbox.plaid.com/item/public_token/exchange";
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
        $beforeDate = date('Y-m-d', strtotime('-1 years'));
        $url = "https://sandbox.plaid.com/investments/transactions/get";
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
        $accountData = $data->accounts;
        foreach ($accountData as $ac){
            if($ac->type == "investment"){
                $accountName = Accounts::where(['account_name' => $ac->name,'user_id' => Auth::user()->id])
                    ->first();
                if(!isset($accountName))
                {
                    $account=Accounts::Create([
                        'user_id' => Auth::user()->id,
                        'account_type' => $ac->type,
                        'account_name' => $ac->name,
                        'account_brokerage' => "Not assigned",
                        'commission' => $ac->balances->current,
                        'set_default' => 0,
                        'plaid_account_id' => $ac->account_id,
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('alert', [
                        'type'=>'error',
                        'message'=>'No more account',
                    ]);
                }
            }
        }
        if(isset($account)){
            $this->dispatchBrowserEvent('alert', [
                'type'=>'success',
                'message'=>'Account Link Successfully',
            ]);
        }else{
            $this->dispatchBrowserEvent('alert', [
                'type'=>'error',
                'message'=>'No more account',
            ]);
        }
        $this->addHoldings($data);
    }

    public function addHoldings($data)
    {
        $response = $data;
        foreach ($response->accounts as $acc)
        {
            $getData = Accounts::where(['account_name' => $acc->name , 'user_id' => Auth::user()->id])->first();
            $getData->update([
                'plaid_account_id' => $acc->account_id,
            ]);
        }
        $account = Accounts::where('user_id',Auth::user()->id)->get();
        foreach($account as $ac)
        {
            foreach ($response->investment_transactions as $it)
            {
                if($ac->plaid_account_id == $it->account_id)
                {
                    foreach ($response->securities as $se)
                    {
                        if($it->security_id == $se->security_id)
                        {
                            $getAccountId = Accounts::where('plaid_account_id', $it->account_id)->first();
                            if($it->type == "buy")
                            {
                                $insertid=Stock::Create([
                                    'user_id'=>Auth::user()->id,
                                    'stock_ticker' => $se->ticker_symbol,
                                    'ave_cost' => $it->price,
                                    'share_number' => $it->quantity,
                                    'date_of_purchase' => $it->date,
                                    'account_id' => $getAccountId->id,
                                ]);
                                $lastInsertedID = $insertid->id;

                                Transaction::Create([
                                    'stock_id' => $lastInsertedID,
                                    'type' => 0,
                                    'ticker_name' =>  $se->ticker_symbol,
                                    'stock' =>  $it->quantity,
                                    'share_price' => $it->price,
                                    'user_id' => Auth::user()->id,
                                    'date_of_transaction' => $it->date,
                                ]);
                            }
                            elseif ($it->type == "sell")
                            {
                                //
                            }
                        }
                    }
                }
            }
        }
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
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
            'commission' => $this->commission,
            'set_default'=>0,
        ]);

        $this->dispatchBrowserEvent('alert', [
            'type'=>'success',
            'message'=>$this->account_id ? 'Account Update Successful' : 'New Account Created Successfully',
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
        $this->commission = $stock->commission;
        $this->openModal();
    }

    public function delete($id)
    {
        $data = Accounts::where('id', $id)->first();
        if ($data['set_default'] == 1) {
            Accounts::find($id)->delete();
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
}
