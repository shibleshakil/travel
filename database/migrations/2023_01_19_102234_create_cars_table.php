<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('slug')->nullable();
            $table->longText('content')->nullable();
            $table->string('youtube_link')->nullable();
            $table->longText('faqs')->nullable();
            $table->integer('passenger')->nullable();
            $table->string('gear_shift')->nullable();
            $table->integer('baggage')->nullable();
            $table->integer('Door')->nullable();
            $table->string('address')->nullable();
            $table->string('map_lat', 20)->nullable();
            $table->string('map_lng', 20)->nullable();
            $table->tinyInteger('map_zoom')->nullable();
            $table->double('price')->nullable();
            $table->double('sale_price')->nullable();
            $table->string('car_number')->nullable();
            $table->tinyInteger('min_day_before_booking')->nullable();
            $table->tinyInteger('min_day_stay')->nullable();
            $table->string('enable_extra_price')->nullable();
            $table->longText('extra_price')->nullable();
            $table->string('status', 50)->nullable();
            $table->tinyInteger('default_state')->default(1);
            $table->tinyInteger('is_feature')->nullable();
            $table->string('feature_image')->nullable();
            $table->text('galary_image')->nullable();

            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->string('deleted_at')->nullable();
            
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
        Schema::dropIfExists('cars');
    }
}
