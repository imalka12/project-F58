<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('free');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('city_id');
            $table->string('title');
            $table->text('description');
            $table->string('condition')->default('free');
            $table->decimal('price', 11, 2);
            $table->boolean('is_price_negotiable')->default(false);
            $table->boolean('is_offers_accepted')->default(false);
            $table->decimal('min_offer', 11, 2)->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->timestamp('renewed_at')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->unsignedBigInteger('approved_by_user_id');
            $table->boolean('is_promoted')->default(false);
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
        Schema::dropIfExists('advertisements');
    }
}
