<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('image');
            $table->text('description');
            $table->boolean('status');
            $table->unsignedBigInteger('category_menu_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('admin_id');
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("category_menu_id")->references("id")->on("menu_categories")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("place_id")->references("id")->on("places")->onDelete("cascade")->cascadeOnUpdate();
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
        Schema::dropIfExists('menus');
    }
}
