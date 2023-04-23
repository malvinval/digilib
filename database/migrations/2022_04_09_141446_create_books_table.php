<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->foreignId("author_id");
            $table->foreignId("category_id");
            $table->text("body");
            $table->text("book_image")->nullable();
            $table->string("publisher");
            $table->string("published_at");
            $table->string("isbn");
            $table->integer("total_pages");
            $table->integer("total_units");
            $table->integer("likes")->default(0);
            $table->integer("comments")->default(0);
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
        Schema::dropIfExists('books');
    }
};
