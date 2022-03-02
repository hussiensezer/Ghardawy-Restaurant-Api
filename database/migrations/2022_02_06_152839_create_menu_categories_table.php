<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('image');
            $table->string('sort');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign("place_id")->references("id")->on("places")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade")->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories');
    }
}
