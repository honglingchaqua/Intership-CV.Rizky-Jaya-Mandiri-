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
        Schema::create('kayus', function (Blueprint $table) {
            $table->id();
            $table->string('nilai')->nullable();
            $table->string('data1')->nullable();
            $table->integer('bobot1')->nullable();
            $table->string('data2')->nullable();
            $table->integer('bobot2')->nullable();
            $table->string('data3')->nullable();
            $table->integer('bobot3')->nullable();
            $table->string('data4')->nullable();
            $table->integer('bobot4')->nullable();
            $table->string('data5')->nullable();
            $table->integer('bobot5')->nullable();
            $table->string('data6')->nullable();
            $table->integer('bobot6')->nullable();
            $table->string('data7')->nullable();
            $table->integer('bobot7')->nullable();
            $table->string('data8')->nullable();
            $table->integer('bobot8')->nullable();
            $table->string('data9')->nullable();
            $table->integer('bobot9')->nullable();
            $table->string('data10')->nullable();
            $table->integer('bobot10')->nullable();
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
        Schema::dropIfExists('kayus');
    }
};
