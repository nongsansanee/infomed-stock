<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('order_no');
            $table->unsignedSmallInteger('unit_id');
            $table->unsignedSmallInteger('stock_item_id');
            $table->float('price');
            $table->string('catalog_number')->nullable();
            $table->string('lot_number')->nullable();
            $table->unsignedSmallInteger('user_id')->default(1);
            $table->smallInteger('stock_categorie_id')->nullable();
            $table->smallInteger('year');
            $table->smallInteger('month');
            $table->date('date_order');
            $table->integer('unit');
            $table->string('status')->default('created');
            $table->json('profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
