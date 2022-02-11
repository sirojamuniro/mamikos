<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignChatRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kos')->table('chat_room', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->constrained('room')->onDelete('cascade')->onUpdate('cascade')->index()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kos')->table('chat_room', function (Blueprint $table) {
            $table->dropColumn('chat_room');
        });
    }
}
