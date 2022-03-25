<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
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
                $findgoogleid = User::where('google_id',$user->id)->first();
                if($findgoogleid)
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
                return redirect()->intended('login')->with('status','<h4 class="text-red-700 text-lg ">Whoops! Your email is not register</h4>');
            }
        } catch (Exception $e) {
//            dd($e->getMessage());
            User::select('google_id')->first();
        }
    }
}
