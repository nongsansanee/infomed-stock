<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('stock_item_id');
            $table->unsignedSmallInteger('user_id')->default(1);
            $table->unsignedSmallInteger('order_item_id')->default(1);
            $table->smallInteger('year');
            $table->smallInteger('month');
            $table->date('date_checkin');
            $table->date('date_expire');
            $table->integer('item_receive');
            $table->integer('item_total')->nullable();
            $table->float('price')->nullable();;
            $table->string('catalog_number')->nullable();
            $table->string('lot_number')->nullable();
            $table->string('status')->default('active');
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
        Schema::dropIfExists('check_in_items');
    }
}
