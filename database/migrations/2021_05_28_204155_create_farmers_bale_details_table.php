<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersBaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers_bale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bale_number')->index('bale_number');
            $table->string('bale_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('id_number')->index('id_number');
            $table->string('serial');
            $table->unsignedBigInteger('weight_at_reception');
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
        Schema::dropIfExists('farmers_bale_details');
    }
}
