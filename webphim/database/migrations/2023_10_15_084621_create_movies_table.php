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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->longText('description');
            $table->integer('status');
            $table->string('slug');
            $table->string('image',255);
            $table->integer('movie_hot');
            $table->integer('resolution');
            $table->integer('subtitle');
            $table->string('year',20);
            $table->string('time',50);
            $table->string('tags',100)->nullable();
            $table->integer('view');
            $table->string('trailer',255);
            $table->integer('episodes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
