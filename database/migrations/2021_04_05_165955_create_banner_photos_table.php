<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_photos', function (Blueprint $table) {
            $table->unsignedBigInteger('banner_id');
            $table->unsignedBigInteger('photo_id');
            $table->timestamps();

            $table->primary(['banner_id','photo_id']);
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_photos');
    }
}
