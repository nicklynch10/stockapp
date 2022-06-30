<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToFactorComparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factor_compares', function (Blueprint $table) {
            $table->index('id');
            $table->index('factor_id');
            $table->index('ticker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factor_compares', function (Blueprint $table) {
            $table->dropIndex('id');
            $table->dropIndex('factor_id');
            $table->dropIndex('ticker');
        });
    }
}
