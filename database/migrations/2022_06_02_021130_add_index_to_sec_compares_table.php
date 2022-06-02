<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToSecComparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sec_compares', function (Blueprint $table) {
            $table->index('ticker1');
            $table->index('ticker2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sec_compares', function (Blueprint $table) {
            $table->dropIndex(['ticker1','ticker2']);
        });
    }
}
