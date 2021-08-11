<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovedstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movedstocks', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('order_id')->index('order_id');
            $table->string('grade');
            $table->integer('weight_at_off_loading')->nullable();
            $table->integer('weight_at_processing')->nullable();
            $table->string('farmer');
            $table->string('market');
            $table->unsignedBigInteger('destination_store_id');
            $table->string('store');
            $table->string('state');
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
        Schema::dropIfExists('movedstocks');
    }
}
