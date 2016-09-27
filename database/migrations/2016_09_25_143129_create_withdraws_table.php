<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->engine='InnoDB';

            $table->increments('id');
            $table->unsignedMediumInteger('user_id')->comment('创建人');
            $table->decimal('money',10,2)->comment('提现金额');
            $table->decimal('real_money',10,2)->comment('实际到账金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('订单状态0创建1完成2失败');
            $table->timestamp('create_time')->useCurrent()->comment('创建时间');
            $table->timestamp('finish_time')->nullable()->comment('完成时间');

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
        Schema::dropIfExists('withdraws');
    }
}
