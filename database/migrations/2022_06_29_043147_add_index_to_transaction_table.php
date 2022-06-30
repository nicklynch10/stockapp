<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->index('id');
            $table->index('stock_id');
            $table->index('type');
            $table->index('user_id');
            $table->index('plaid_investment_transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->dropIndex('id');
            $table->dropIndex('stock_id');
            $table->dropIndex('type');
            $table->dropIndex('user_id');
            $table->dropIndex('plaid_investment_transaction_id');
        });
    }
}
