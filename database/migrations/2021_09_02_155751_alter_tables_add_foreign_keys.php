<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // user has a role
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
        
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('provinces');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('districts');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });
        
        Schema::table('option_group_values', function (Blueprint $table) {
            $table->foreign('option_group_id')->references('id')->on('option_groups');
        });

        Schema::table('sub_category_options', function (Blueprint $table) {
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->foreign('option_group_id')->references('id')->on('option_groups');
        });

        Schema::table('advertisements', function (Blueprint $table) {
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('approved_by_user_id')->references('id')->on('users');
        });

        Schema::table('advertisement_images', function (Blueprint $table) {
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // delete role id key from users
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['payment_id']);
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('option_group_values', function (Blueprint $table) {
            $table->dropForeign(['option_group_id']);
        });

        Schema::table('sub_category_options', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['option_group_id']);
        });

        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['approved_by_user_id']);
        });

        Schema::table('advertisement_images', function (Blueprint $table) {
            $table->dropForeign(['advertisement_id']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
