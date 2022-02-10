<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('receive');
            $table->enum('from', ['place', 'system', 'customer', 'caption']);
            $table->enum('to', ['place', 'system', 'customer', 'caption']);
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('place_id');
            $table->text('message');
            $table->boolean('readed')->default(0);
            $table->boolean('status');
            $table->timestamps();

            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("place_id")->references("id")->on("places")->onDelete("cascade")->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
