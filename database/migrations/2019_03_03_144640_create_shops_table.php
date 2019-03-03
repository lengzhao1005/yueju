<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',50)->index()->nullable()->comment('商铺编码');
            $table->string('address')->nullable()->comment('商铺地址');
            $table->string('construction')->nullable()->comment('商铺结构');
            $table->enum('status', ['1','2'])->default('1')->comment('状态 1：可用；2：不可用');
            $table->string('belongto')->nullable()->index()->comment('所属人');
            $table->string('link_phone')->nullable()->index()->comment('联系电话');
            $table->integer('plot_id')->nullable()->index()->comment('所属小区');
            $table->text('comment')->nullable()->comment('评论');
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
        Schema::dropIfExists('shops');
    }
}
