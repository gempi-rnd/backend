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
        Schema::create('tests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tenant_id');
            $table->uuid('topic_id');
            $table->text('code')->unique();
            $table->text('title');
            $table->text('description')->nullable();
            $table->integer('total_questions');
            $table->integer('total_duration');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->jsonb('settings')->nullable();
            $table->text('status')->default('draft');
            $table->timestamps();
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onCascade('no action');
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onCascade('no action');
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
        Schema::dropIfExists('tests');
    }
};
