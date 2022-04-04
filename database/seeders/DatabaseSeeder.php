<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Stock;
use App\Models\StockTicker;
use App\Models\Transaction;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $n=User::factory()->create([
            'name' => 'Nick Lynch',
            'first_name' => 'Nick',
            'last_name' => "Lynch",
            'email' => "nick@taxghost.com",
            'password'=>bcrypt('z'),
        ]);
    }
}
