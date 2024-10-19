<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->string('title');
            $table->text('content');
            $table->string('short_description')->nullable();
            $table->string('author')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('are_tags_generated')->default(false);
            $table->string('slug')->unique()->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
};
