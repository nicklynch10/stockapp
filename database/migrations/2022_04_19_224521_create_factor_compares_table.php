<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorComparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor_compares', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('SI_id')->nullable();
            $table->unsignedBigInteger('factor_id')->nullable();
            $table->string('ticker')->nullable();
            $table->string('factor_name')->nullable();

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
        Schema::dropIfExists('factor_compares');
    }
}
