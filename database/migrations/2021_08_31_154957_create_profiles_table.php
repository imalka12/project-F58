<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('telephone', 10)->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_seller')->default(false);
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->timestamp('membership_expire_at')->nullable();
            $table->boolean('is_blacklisted')->default(false);
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
        Schema::dropIfExists('profiles');
    }
}
