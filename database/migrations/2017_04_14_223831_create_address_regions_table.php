<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('regions', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('place');
        //     $table->unsignedInteger('post_code');
        //     $table->unsignedInteger('sirsup');
        //     $table->smallInteger('place_type')->unsigned();
        //     $table->smallInteger('type')->unsigned();
        //     $table->tinyInteger('level')->unsigned();
        //     $table->tinyInteger('med')->unsigned();
        //     $table->tinyInteger('area')->unsigned();
        //     $table->smallInteger('fsj')->unsigned();
        //     $table->bigInteger('fsl')->unsigned();
        //     $table->string('rang')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('regions');
    }
}
