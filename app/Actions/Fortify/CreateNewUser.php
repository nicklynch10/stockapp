<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => [
//                $this->passwordRules(),
//                'different:current_password',
//                'min:8',             // must be at least 10 characters in length
//                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
//            ],
            'password_confirmation'=> 'required_with:password|same:password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ],
//            ['password.regex' => 'The Password should be combination of alphanumeric and special character']
        )->validate();

        $insert= User::create([
            'name' => $input['first_name']." ".$input['last_name'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
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

        return $insert;

    }
}
