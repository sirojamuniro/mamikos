<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kos')->create('chat_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sender_id')->nullable()->index();
            $table->integer('receiver_id')->nullable()->index();
            $table->mediumText('message')->nullable();
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
        Schema::connection('kos')->dropIfExists('chat_room');
    }
}
