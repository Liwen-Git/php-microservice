<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateWinnerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('winner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('中奖用户id');
            $table->integer('prize_id')->comment('奖品id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winner');
    }
}
