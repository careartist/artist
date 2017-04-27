<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cui_number');
            $table->string('legal_name');
            $table->string('authority');
            $table->unsignedInteger('user_id');
            $table->boolean('approved')->default(0);
            $table->boolean('rejected')->default(0);
            $table->unsignedInteger('operated_by')->nullable();
            $table->timestamp('operated_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('user_id');
            $table->unique('cui_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_profiles');
    }
}
