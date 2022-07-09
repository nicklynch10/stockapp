<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatsToSecInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sec_infos', function (Blueprint $table) {
            $table->decimal('week52Low', 10, 5)->nullable();
            $table->decimal('week52High', 10, 5)->nullable();
            $table->decimal('iexClose', 10, 5)->nullable();
            $table->longText('logoUrl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
