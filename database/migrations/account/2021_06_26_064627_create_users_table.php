<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('account')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('username')->unique();
            $table->enum('gender', ['Male', 'Female'])->default('Male')->index();
            $table->date('dob');
            $table->string('introduction');
            $table->mediumText('self_description');
            $table->boolean('is_verified')->default(false);
            $table->string('verification_code')->nullable();
            $table->string('forgot_password_token')->nullable();
            $table->unsignedBigInteger('id_city')->index();
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
        Schema::connection('account')->dropIfExists('users');
    }
}
