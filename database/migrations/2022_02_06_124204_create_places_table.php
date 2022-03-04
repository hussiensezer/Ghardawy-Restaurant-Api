<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->decimal('latitude',10, 8);
            $table->decimal('longitude',11, 8);
            $table->string('thumb');
            $table->string('banner');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('owner_id');
            $table->string('address');
            $table->string('phone');
            $table->string('working_hours');
            $table->boolean('status')->default(1);
            $table->string('tax');
            $table->string('fees');
            $table->string('delivers');
            $table->timestamps();
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade")->cascadeOnUpdate();
            $table->foreign("owner_id")->references("id")->on("owners")->onDelete("cascade")->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
