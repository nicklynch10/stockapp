<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockUpdateView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_stock_update AS
                SELECT
                    stock.id,
                    stock.id as stock_id,
                    stock.stock_ticker,
                    (stock.current_share_price-stock.ave_cost) as dchange,
                    (((stock.current_share_price/stock.ave_cost)-1)*100) as pchange,
                    (stock.current_share_price*stock.share_number) as current_total_value,
                    (stock.ave_cost*stock.share_number) as total_cost,
                    ((stock.current_share_price*stock.share_number)-(stock.ave_cost*stock.share_number)) as total_gain_loss
                FROM stock
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_stock_update`;
            SQL;
    }
}
