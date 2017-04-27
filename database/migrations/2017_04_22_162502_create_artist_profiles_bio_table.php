<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistProfilesBioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_profiles_bio', function (Blueprint $table) {
            $table->increments('id');
            $table->text('bio');
            $table->text('tags');
            $table->string('subdomain')->nullable();
            $table->unsignedInteger('profile_id');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('profile_id');
            $table->unique(['profile_id', 'subdomain']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_profiles_bio');
    }
}
