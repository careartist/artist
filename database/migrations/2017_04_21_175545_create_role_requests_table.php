<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artist_profile_id');
            $table->unsignedInteger('user_id');
            $table->string('role');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('user_id');
            $table->unique('artist_profile_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_requests');
    }
}
