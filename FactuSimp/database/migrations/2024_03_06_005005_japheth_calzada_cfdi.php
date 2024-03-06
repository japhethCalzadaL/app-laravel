<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('japheth_calzada_cfdi', function (Blueprint $table) {
            $table->id();
            $table->string('rfc_transmitter');
            $table->string('rfc_receiver');
            $table->string('error')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('japheth_calzada_cfdi');

    }
};
