<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_question_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tenant_id');
            $table->uuid('test_session_id');
            $table->uuid('question_id');
            $table->jsonb('options');
            $table->jsonb('user_answer');
            $table->text('status');
            $table->text('time_taken');
            $table->integer('score');
            $table->integer('irt_score');
            $table->boolean('correct');
            $table->foreign('test_session_id')
                ->references('id')
                ->on('test_sessions')
                ->onCascade('no action');
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onCascade('no action');
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onCascade('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_question_sessions');
    }
};
