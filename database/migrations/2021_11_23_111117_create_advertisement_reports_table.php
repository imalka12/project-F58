<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id'); // reporting advertisement
            $table->string('reason');
            $table->text('comments');
            $table->unsignedBigInteger('user_id'); // reporting user
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
        Schema::dropIfExists('advertisement_reports');
    }
}
