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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->bigInteger('tenant_id')->unsigned();
            $table->text('full_name');
            $table->text('email')->unique();
            $table->text('whatsapp')->unique();
            $table->text('photo')->nullable();
            $table->timestamps();
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onCascade('no action');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('students');
    }
};
