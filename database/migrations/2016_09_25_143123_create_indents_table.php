<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indents', function (Blueprint $table) {
            $table->engine='InnoDB';

            $table->increments('id');
            $table->unsignedMediumInteger('user_id')->comment('创建人');
            $table->decimal('money',10,2)->comment('充值金额');
            $table->decimal('real_money',10,2)->comment('实际到账金额');
            $table->unsignedTinyInteger('type')->comment('充值渠道');
            $table->string('order',36)->default('')->comment('订单ID');
            $table->unsignedTinyInteger('status')->default(0)->comment('订单状态0创建1完成2审核');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indents');
    }
}
