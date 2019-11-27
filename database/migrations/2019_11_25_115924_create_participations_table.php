<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('scout_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('picture')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->bigInteger('FK_GRP')->unsigned()->index()->nullable();
            $table->bigInteger('FK_TBL')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participations');
    }
}
