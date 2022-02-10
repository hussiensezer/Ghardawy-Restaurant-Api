<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('caption_id');
            $table->enum('status', ['Pending', 'Preparing','On-Way','Delivered', 'Canceled','Returned']);
            $table->string('tax');
            $table->string('fees');
            $table->string('delivered-fees');
            $table->string('total-price');
            $table->timestamps();

            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("place_id")->references("id")->on("places")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("caption_id")->references("id")->on("captions")->onDelete("cascade")->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
