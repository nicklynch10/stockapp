<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sec_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable(); // last user to pull data, if applicable
            $table->string('ticker')->nullable();
            $table->string('company_name')->nullable();
            $table->string('type')->nullable();
            $table->decimal('peRatio', 10, 5)->nullable();
            $table->decimal('year1ChangePercent', 10, 5)->nullable();
            $table->double('marketcap', 2)->nullable();

            $table->longText('price_data')->nullable();
            $table->longText('stats_data')->nullable();
            $table->date('data_update_date')->nullable();
            $table->decimal('std', 10, 5)->nullable(); // standard deviation

            $table->decimal('div_yield', 10, 5)->nullable(); //dividend yield
            $table->decimal('beta', 10, 5)->nullable();
            $table->decimal('calced_beta', 10, 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sec_infos');
    }
}
