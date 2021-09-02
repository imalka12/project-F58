<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id');
            $table->string('image');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured_image')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisement_images');
    }
}
