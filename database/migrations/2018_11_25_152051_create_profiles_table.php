<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->string('display_name', 50)->nullable();
            $table->string('slug_name', 50)->nullable()->unique();
            $table->unsignedInteger('county_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('tagline')->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('personal_url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');

            $table->foreign('county_id')
                ->references('id')
                ->on('counties')
                ->onDelete('set null');

        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('profiles');

        Schema::enableForeignKeyConstraints();
    }
}
