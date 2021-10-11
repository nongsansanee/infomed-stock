<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StockItem;

class CreateStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('stock_id');
            $table->smallInteger('stock_categorie_id')->nullable();
            $table->unsignedSmallInteger('user_id')->default(1);
            $table->string('item_code');
            $table->string('item_name');
            $table->integer('unit_count_id');
            $table->integer('item_receive');
            $table->date('date_receive');
            $table->date('date_expire');
            $table->float('price');
            $table->string('catalog_number')->nullable();
            $table->string('lot_number')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
       // StockItem::loadData('data_stock_item');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_items');
    }
}
