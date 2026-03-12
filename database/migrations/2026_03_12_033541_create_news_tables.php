<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 250);
            $table->enum('role', ['USER', 'ADMIN'])->default('USER');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id_tags');
            $table->string('name', 100);
        });

        Schema::create('article', function (Blueprint $table) {
            $table->increments('id_article');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('content');
            $table->string('image')->nullable();
            $table->enum('status', ['draft', 'published']);
            $table->integer('views')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });

        Schema::create('article_tags', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('tags_id');
            $table->foreign('article_id')->references('id_article')->on('article');
            $table->foreign('tags_id')->references('id_tags')->on('tags');
        });

        Schema::create('coment', function (Blueprint $table) {
            $table->increments('id_coment');
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('user')->nullable();
            $table->text('content');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->dateTime('created_at')->nullable();
            $table->foreign('article_id')->references('id_article')->on('article');
            $table->foreign('user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coment');
        Schema::dropIfExists('article_tags');
        Schema::dropIfExists('article');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('users');
    }
};
