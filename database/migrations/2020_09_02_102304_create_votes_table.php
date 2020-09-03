<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('user_id');

//            單選(0)/多選(1)
            $table->tinyInteger('type')->default(0);
//            選項是否是文字(1)/圖片(0)
            $table->tinyInteger('option_type')->default(0);
            $table->timestamp('create_date')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->timestamp('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
