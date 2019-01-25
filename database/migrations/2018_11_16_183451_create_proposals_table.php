<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id')->nullable();
            $table->decimal('price', 20, 2);
            $table->text('description');
            $table->unsignedTinyInteger('duration')->nullable();
            $table->unsignedTinyInteger('duration_type')->nullable();
            $table->date('available_from')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('withdrawn_at')->nullable();
            $table->text('withdraw_reason')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->foreign('project_id')
                    ->references('id')->on('projects')
                    ->onDelete('set null');

            $table->unique(['user_id','project_id']);
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

        Schema::dropIfExists('proposals');

        Schema::enableForeignKeyConstraints();
    }
}
