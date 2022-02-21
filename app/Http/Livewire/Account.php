<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Account As Accounts;


class Account extends Component
{
    public $isOpen = 0;
    public $user_id,$account_type,$account_name,$account_brokerage,$commission,$account_id;
    public function render()
    {
        $this->account=Accounts::where('user_id',Auth::user()->id)->get();
        return view('livewire.account');
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

    private function resetInputFields(){
        $this->account_type = '';
        $this->account_name = '';
        $this->account_brokerage = '';
        $this->commission = '';
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
        ]);

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>$this->account_id ?'Account Update Successfully':'New Account Create Successfully',
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
}
