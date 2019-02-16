<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->unique();
            $table->string('email',100)->unique();
            $table->string('phone',20)->nullable()->unique();
            $table->string('password');
            $table->tinyInteger('is_admin')->default(0)->comment('是否是管理员；0：普通用户；1：普通管理；2：超管');
            $table->string('avatar')->default(0);
            $table->string('confirmation_token')->nullable();
            $table->smallInteger('is_active')->default(0);
            $table->string('settings')->nullable();
            $table->string('api_token',64)->nullable()->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
