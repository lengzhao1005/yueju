<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRbacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->unique()->comment('角色名称');
            $table->string('description')->nullable()->comment('角色描述');
            $table->enum('status',['F','T'])->default('T')->comment('F:禁用；T启用');
            $table->timestamps();
        });
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('role_id')->index();
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->unique()->comment('权限名称');
            $table->string('url')->comment('权限路由');
            $table->string('method',50)->default('GET')->comment('请求方式');
            $table->tinyInteger('group')->index()->comment('权限分组');
            $table->string('description')->nullable()->comment('权限描述');
            $table->enum('status',['F','T'])->default('T')->comment('F:禁用；T启用');
            $table->timestamps();
        });
        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->index();
            $table->integer('role_id')->index();
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('prmission_role');
    }
}
