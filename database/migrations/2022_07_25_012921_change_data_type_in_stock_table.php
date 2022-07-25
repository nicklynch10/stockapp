<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;

class ChangeDataTypeInStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock', function (Blueprint $table) {
            if (!Type::hasType('double')) {
                Type::addType('double', FloatType::class);
            }
            Schema::table('stock', function ($table) {
                $table->double('market_cap', 15, 2)->default(0)->index()->change();
                $table->double('current_share_price', 15, 2)->default(0)->index()->change();
                $table->double('ave_cost', 15, 2)->default(0)->change();
                $table->double('share_number', 15, 2)->default(0)->change();
                $table->double('dchange', 15, 2)->default(0)->change();
                $table->double('pchange', 15, 2)->default(0)->change();
                $table->double('current_total_value', 15, 2)->default(0)->change();
                $table->double('total_cost', 15, 2)->default(0)->change();
                $table->double('total_gain_loss', 15, 2)->default(0)->change();
            });
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
            Schema::dropIfExists('stock');
        });
    }
}

