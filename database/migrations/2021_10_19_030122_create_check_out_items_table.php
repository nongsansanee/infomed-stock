<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_out_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('stock_item_id');
            $table->unsignedSmallInteger('user_id')->default(1);
            $table->smallInteger('year');
            $table->smallInteger('month');
            $table->date('date_checkout');
            $table->integer('unit');
            $table->string('status')->default('checkout');
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
        Schema::dropIfExists('check_out_items');
    }
}
