<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecComparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sec_compares', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('SI1_id')->nullable();
            $table->unsignedBigInteger('SI2_id')->nullable();
            $table->string('ticker1')->nullable();
            $table->string('ticker2')->nullable();

            $table->decimal('correlation', 10, 5)->nullable();
            $table->decimal('r2', 10, 5)->nullable();
            $table->decimal('coefficent', 10, 5)->nullable();
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
        Schema::dropIfExists('sec_compares');
    }
}
