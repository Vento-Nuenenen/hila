<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations_points', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->bigInteger('FK_PRT')->unsigned()->index();
	        $table->bigInteger('FK_POINT')->unsigned()->index();
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
        Schema::dropIfExists('participations_points');
    }
}
