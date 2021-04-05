<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('ordered_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();

            $table->unique('action_id','order_id');
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
