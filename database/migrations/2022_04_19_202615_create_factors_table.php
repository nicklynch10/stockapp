<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
            $table->longText('description')->nullable();

            // comes from SI objects
            $table->unsignedBigInteger('SI1_id')->nullable();
            $table->unsignedBigInteger('SI2_id')->nullable();
            $table->string('ticker1')->nullable();
            $table->string('ticker2')->nullable();
            $table->longText('change_data1')->nullable();
            $table->longText('change_data2')->nullable();
            $table->longText('dates_data1')->nullable();
            $table->longText('dates_data2')->nullable();

            // calculated during refresh
            $table->string('operation')->default("-");
            $table->longText('change_data')->nullable();
            $table->longText('dates_data')->nullable();
            $table->date('date_updated')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('range')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factors');
    }
}
