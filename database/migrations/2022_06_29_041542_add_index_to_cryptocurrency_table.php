<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToCryptocurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cryptocurrency', function (Blueprint $table) {
            $table->index('id');
            $table->index('crypto_symbol');
            $table->index('crypto_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cryptocurrency', function (Blueprint $table) {
            $table->dropIndex(['id','crypto_symbol','crypto_name']);
        });
    }
}
