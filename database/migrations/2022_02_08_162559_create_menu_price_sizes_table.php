<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPriceSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_price_sizes', function (Blueprint $table) {
            $table->id();
            $table->text('price');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('admin_id');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign("size_id")->references("id")->on("sizes")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("menu_id")->references("id")->on("menus")->onDelete("cascade")->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_price_sizes');
    }
}
