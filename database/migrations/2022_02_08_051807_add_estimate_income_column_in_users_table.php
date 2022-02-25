<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstimateIncomeColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('estimate_income')->nullable()->change();;
            $table->string('income_label')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('estimate_income');
                $table->dropColumn('income_label');
        });
    }
}
