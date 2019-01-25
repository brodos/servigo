<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->unsignedTinyInteger('rating');
            $table->text('message')->nullable();
            $table->text('reply')->nullable();
            $table->integer('from_user_id')->unsigned()->nullable();
            $table->integer('to_user_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->timestamp('created_at');
            $table->timestamp('replied_at')->nullable();

            $table->foreign('from_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('to_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('set null');

            $table->unique(['from_user_id','to_user_id','project_id']);
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

        Schema::dropIfExists('feedback');

        Schema::enableForeignKeyConstraints();
    }
}
