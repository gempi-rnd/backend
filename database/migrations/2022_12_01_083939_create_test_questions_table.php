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
        Schema::create('test_questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('order');
            $table->uuid('tenant_id');
            $table->uuid('question_id');
            $table->uuid('test_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onCascade('no action');
            $table->foreign('test_id')
                ->references('id')
                ->on('tests')
                ->onCascade('no action');
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onCascade('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_questions');
    }
};
