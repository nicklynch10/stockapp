<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDollerChangeColumnInStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock', function (Blueprint $table) {
            $table->string('dchange')->comment('Doller Change')->after('account_id')->nullable();
            $table->string('pchange')->comment('Percentage Change')->after('dchange')->nullable();
            $table->string('current_total_value')->after('pchange')->nullable();
            $table->string('total_cost')->after('current_total_value')->nullable();
            $table->string('total_gain_loss')->after('total_cost')->nullable();
            $table->string('total_long_term_gains')->after('total_gain_loss')->nullable();
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
            $table->dropColumn('dchange');
            $table->dropColumn('pchange');
            $table->dropColumn('current_total_value');
            $table->dropColumn('total_cost');
            $table->dropColumn('total_gain_loss');
            $table->dropColumn('total_long_term_gains');
        });
    }
}
