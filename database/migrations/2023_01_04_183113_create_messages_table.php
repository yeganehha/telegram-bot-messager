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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('symbol_id')->nullable();
            $table->foreign('symbol_id')->on('symbols')->references('id')->onDelete('set null')->onUpdate('cascade');
            $table->enum('position' , ['sell' , 'buy'])->default('sell');
            $table->string('entry' )->nullable();
            $table->string('target' )->nullable();
            $table->string('tp1' )->nullable();
            $table->string('tp2' )->nullable();
            $table->string('tp3' )->nullable();
            $table->string('stop' )->nullable();
            $table->text('description' )->nullable();
            $table->text('signature' )->nullable();
            $table->text('message' )->nullable();
            $table->string('telegram_id' )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
