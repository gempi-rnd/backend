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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tenant_id');
            $table->uuid('topic_id');
            $table->uuid('difficult_level_id');
            $table->uuid('question_type_id');
            $table->text('question');
            $table->jsonb('correct_answers')->nullable();
            $table->jsonb('options')->nullable();
            $table->jsonb('solutions')->nullable();
            $table->boolean('has_attachment')->nullable();
            $table->jsonb('attachments')->nullable();
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onCascade('no action');
            $table->foreign('difficult_level_id')
                ->references('id')
                ->on('difficulty_levels')
                ->onCascade('no action');
            $table->foreign('question_type_id')
                ->references('id')
                ->on('question_types')
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
        Schema::dropIfExists('questions');
    }
};
