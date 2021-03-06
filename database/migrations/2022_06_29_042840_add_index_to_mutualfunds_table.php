<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToMutualfundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mutualfunds', function (Blueprint $table) {
            $table->string('name')->change();
            $table->index('id');
            $table->index('symbol');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutualfunds', function (Blueprint $table) {
            $table->dropIndex('id');
            $table->dropIndex('symbol');
            $table->dropIndex('name');
        });
    }
}
