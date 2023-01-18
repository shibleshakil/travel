<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->string('slug')->nullable();
            $table->longText('content')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger('number')->nullable();
            $table->tinyInteger('beds')->nullable();
            $table->integer('size')->nullable();
            $table->tinyInteger('adults')->nullable();
            $table->tinyInteger('children')->nullable();
            $table->tinyInteger('min_day_stays')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('feature_image')->nullable();
            $table->text('galary_image')->nullable();

            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->string('deleted_at')->nullable();
            
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('hotel_rooms');
    }
}
