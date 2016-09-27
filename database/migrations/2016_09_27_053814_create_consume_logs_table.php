<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consume_logs', function (Blueprint $table) {
            $table->engine='InnoDB';

            $table->increments('id');
            $table->unsignedMediumInteger('user_id')->comment('创建人');
            $table->decimal('money',10,2)->comment('消费金额');
            $table->unsignedTinyInteger('type')->comment('消费类型');
            $table->unsignedInteger('relative_id')->comment('关联订单ID');

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
        Schema::dropIfExists('consume_logs');
    }
}
