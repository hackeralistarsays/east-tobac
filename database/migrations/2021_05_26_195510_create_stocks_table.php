<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->unsignedBigInteger('grade_id')->index('grade_id');
            $table->string('grade');
            $table->integer('weight_at_off_loading')->nullable();
            $table->integer('weight_at_processing')->nullable();
            $table->string('farmer');
            $table->string('market');
            $table->unsignedBigInteger('destination_store_id')->index('destination_store_id')->default(1);
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
        Schema::dropIfExists('stocks');
    }
}
