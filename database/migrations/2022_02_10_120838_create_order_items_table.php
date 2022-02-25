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
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('order_id');
            $table->string('price');
            $table->string('quantity');
            $table->timestamps();

            $table->foreign("menu_id")->references("id")->on("menus")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("size_id")->references("id")->on("menu_price_sizes")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("place_id")->references("id")->on("places")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->cascadeOnUpdate();

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
