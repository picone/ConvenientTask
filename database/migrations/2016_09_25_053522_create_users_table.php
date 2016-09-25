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
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->engine='InnoDB';

            $table->unsignedMediumInteger('id');
            $table->string('username',25)->comment('用户名');
            $table->string('email',35)->comment('电子邮箱');
            $table->decimal('money',10,2)->default(0)->comment('余额');
            $table->rememberToken();
            $table->unsignedTinyInteger('status')->default(0)->comment('用户状态0正常1禁用');

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('users');
    }
}
