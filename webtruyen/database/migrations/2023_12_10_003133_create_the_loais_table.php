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
        Schema::create('theloai', function (Blueprint $table) {
            $table->id();
            $table->string('tentheloai',100);
            $table->string('slug');
            $table->string('mota',255)->nullable();
            $table->integer('khoa')->default(1);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theloai');
    }
};
