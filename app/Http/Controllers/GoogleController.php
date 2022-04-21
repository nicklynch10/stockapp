<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findemail = User::where('email',$user->email)->first();
            if($findemail)
            {
                if($findemail['google_id'])
                {
                    Auth::login($findemail);
                    return redirect()->intended('portfolio');
                }
                else
                {
                    $findemail->update([
                    'google_id'=>$user->id,
                    ]);
                    Auth::login($findemail);
                    return redirect()->intended('portfolio');
                }
            }
            else
            {
                // Register user code
                $insert= User::create([
                    'name' => $user['given_name']." ".$user['family_name'],
                    'first_name' => $user['given_name'],
                    'last_name' => $user['family_name'],
                    'email' => $user->email,
                    'password' => Hash::make('z'),
                ]);
                $lastInsertedID = $insert->id;

                Account::create([
                    'user_id'=>$lastInsertedID,
                    'account_type'=> 'Individual Brokerage Account',
                    'account_name'=>'Taxable Account',
                    'account_brokerage'=>'Not assigned',
                    'commission'=>0,
                    'set_default'=>1,
                ]);

                Auth::login($insert);
                return redirect()->intended('portfolio');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
