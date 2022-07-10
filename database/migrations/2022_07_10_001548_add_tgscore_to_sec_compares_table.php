<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTgscoreToSecComparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sec_compares', function (Blueprint $table) {
            $table->integer('total_weights')->default(0);
            $table->integer('stats_score')->default(0);
            $table->integer('quant_score')->default(0);
            $table->integer('TG_score')->default(0);



            $table->integer('matching_tags')->default(0);
            $table->integer('matching_country')->default(0);
            $table->integer('matching_region')->default(0); // N/A for now
            $table->integer('matching_sector')->default(0);
            $table->integer('matching_industry')->default(0);
            $table->integer('matching_IEXsector')->default(0);
            $table->integer('matching_IEXindustry')->default(0);
            $table->integer('matching_primarySicCode')->default(0);

            $table->integer('matching_PE')->default(0);

            //bands for matching PE:
            // <= 0
            // 0-10
            // 10-20
            // 20-30
            // 30-40
            // 40-50
            // 50-100
            // >100

            $table->integer('matching_marketcap')->default(0);
            // bands for marketcap (note: this is in millions $)
            //0 - 500M
            // 500 - 2,000
            // 2,000 - 50,000
            // 50,000 - 150,000
            // 150,000 - 500,000
            // 500,000 - 1,000,000
            // >1,000,000

            $table->integer('matching_beta')->default(0);
            // <0 - .3
            // .3 - .7
            // .7 - .9
            // .9 - 1.1
            // 1.1 - 1.3
            // 1.3 - 1.7
            // 1.7 - 2.5
            // >2.5
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
            //
        });
    }
}
