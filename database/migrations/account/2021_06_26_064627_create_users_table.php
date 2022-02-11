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
            $table->bigIncrements('id');
            $table->string('fullname')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('username')->unique();
            $table->enum('gender', ['male', 'female'])->default('male')->index();
            $table->date('dob')->nullable();
            $table->string('introduction')->nullable();
            $table->mediumText('self_description')->nullable();
            $table->boolean('is_verified')->default(false)->index();
            $table->string('verification_code')->nullable();
            $table->string('forgot_password_token')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('email')->unique()->constrained('auth.users','email')->onDelete('cascade')->onUpdate('cascade')->index();
            $table->unsignedBigInteger('id_city')->nullable()->constrained('cities')->onDelete('set null')->onUpdate('cascade')->index();
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
