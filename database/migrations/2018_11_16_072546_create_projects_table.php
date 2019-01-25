<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedTinyInteger('asap')->default(0);
            $table->timestamp('published_at')->nullable()->index();
            $table->unsignedInteger('selected_proposal_id')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('moderator_message')->nullable();
            $table->timestamp('approved_at')->nullable()->index();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onDelete('set null');

            $table->foreign('selected_proposal_id')
                    ->references('id')->on('proposals')
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

        Schema::dropIfExists('projects');

        Schema::enableForeignKeyConstraints();
    }
}
