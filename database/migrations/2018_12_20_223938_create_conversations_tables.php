<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->integer('project_id')->unsigned();
            $table->integer('proposal_id')->unsigned();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onDelete('cascade');

            $table->foreign('proposal_id')
                    ->references('id')
                    ->on('proposals')
                    ->onDelete('cascade');

            $table->unique(['project_id', 'proposal_id']);
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->integer('conversation_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('type')->default('text');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('conversation_id')
                ->references('id')
                ->on('conversations')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('conversation_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('conversation_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('conversation_id')
                ->references('id')
                ->on('conversations')
                ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

        // Schema::create('message_notification', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('message_id')->unsigned();
        //     $table->integer('conversation_id')->unsigned();
        //     $table->integer('user_id')->unsigned();
        //     $table->boolean('is_seen')->default(false);
        //     $table->boolean('is_sender')->default(false);
        //     $table->boolean('flagged')->default(false);
        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->index(['user_id', 'message_id']);

        //     $table->foreign('message_id')
        //         ->references('id')->on('mc_messages')
        //         ->onDelete('cascade');

        //     $table->foreign('conversation_id')
        //         ->references('id')->on('mc_conversations')
        //         ->onDelete('cascade');

        //     $table->foreign('user_id')
        //         ->references('id')->on('users')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('conversations');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversation_user');

        Schema::enableForeignKeyConstraints();
    }
}
