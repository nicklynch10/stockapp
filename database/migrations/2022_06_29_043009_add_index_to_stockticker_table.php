<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToStocktickerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stockticker', function (Blueprint $table) {
            $table->index('id');
            $table->index('ticker');
            $table->index('ticker_company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stockticker', function (Blueprint $table) {
            $table->dropIndex(['id','ticker','ticker_company']);
        });
    }
}
