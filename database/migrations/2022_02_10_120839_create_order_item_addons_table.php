<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_addons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('addon_id');
            $table->timestamps();
            $table->foreign("order_item_id")->references("id")->on("order_items")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("addon_id")->references("id")->on("addons")->onDelete("cascade")->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item_addons');
    }
}
