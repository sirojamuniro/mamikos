<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('soal')->create('soal', function (Blueprint $table) {
            $table->increments('id');
            $table->text('category')->nullable();
            $table->string('description')->nullable();
            $table->string('thumbnail');
            $table->string('tag');
            $table->bigInteger('price');
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
        Schema::connection('soal')->dropIfExists('soal');
    }
}
