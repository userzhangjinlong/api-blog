<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->index();
            $table->string('title',20);
            $table->string('img_url', 255); //封面图片
            $table->string('description', 40);
            $table->text('content');
            $table->integer('brow_volume'); //浏览量
            $table->integer('thumbs_up'); //点赞次数
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
        Schema::dropIfExists('articles');
    }
}
