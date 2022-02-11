<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardingHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kos')->create('boarding_house', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->decimal('price', 10,  2)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('user_id')->nullablle()->constrained('account.users','id')->onDelete('cascade')->onUpdate('cascade')->index();
            $table->unsignedBigInteger('province_id')->nullablle()->constrained('account.provinces','id')->onDelete('set null')->onUpdate('cascade')->index();
            $table->unsignedBigInteger('city_id')->nullablle()->constrained('account.cities','id')->onDelete('set null')->onUpdate('cascade')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kos')->dropIfExists('boarding_house');
    }
}
