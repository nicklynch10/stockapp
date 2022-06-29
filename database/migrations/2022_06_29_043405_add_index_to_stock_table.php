<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock', function (Blueprint $table) {
            $table->index('id');
            $table->index('user_id');
            $table->index('stock_ticker');
            $table->index('company_name');
            $table->index('security_id');
            $table->index('ave_cost');
            $table->index('share_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock', function (Blueprint $table) {
            $table->dropIndex(['id','user_id','stock_ticker','company_name','security_id','ave_cost','share_number']);
        });
    }
}
