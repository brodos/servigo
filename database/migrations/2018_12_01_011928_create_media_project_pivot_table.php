<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaProjectPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('media_project', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('project_id');
            $table->timestamps();

            $table->foreign('media_id')
                ->references('id')->on('media')
                ->onDelete('cascade');

            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });

        Schema::create('media_proposal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('proposal_id');
            $table->timestamps();

            $table->foreign('media_id')
                ->references('id')->on('media')
                ->onDelete('cascade');

            $table->foreign('proposal_id')
                ->references('id')->on('proposals')
                ->onDelete('cascade');
        });

        Schema::create('media_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('media_id')
                ->references('id')->on('media')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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

        Schema::dropIfExists('media_project');
        Schema::dropIfExists('media_proposal');
        Schema::dropIfExists('media_profile');

        Schema::enableForeignKeyConstraints();
    }
}
