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

            // from IEX info Request
            $table->string('company_name')->nullable();
            $table->decimal('peRatio', 10, 5)->nullable();
            $table->decimal('year1ChangePercent', 10, 5)->nullable();
            $table->double('marketcap', 2)->nullable();
            $table->decimal('div_yield', 10, 5)->nullable(); //dividend yield
            $table->decimal('beta', 10, 5)->nullable();
            $table->longText('info_data')->nullable();

            //from IEX Historical Data Request
            $table->longText('historical_data')->nullable();
            $table->longText('price_data')->nullable();
            $table->longText('change_data')->nullable();
            $table->longText('volume_data')->nullable();
            $table->longText('date_data')->nullable();

            //from IEX Historical Data Request
            $table->longText('IEXpeer_data')->nullable();

            //from IEX Company Data Request
            $table->string('type')->nullable();
            $table->string('security_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('sector')->nullable();
            $table->longText('company_tags')->nullable();
            $table->longText('company_data')->nullable();

            // calculated from change_data
            $table->date('date_updated')->nullable();
            $table->decimal('std', 10, 5)->nullable(); // standard deviation
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
