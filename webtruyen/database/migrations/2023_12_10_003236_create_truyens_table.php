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
        Schema::create('truyen', function (Blueprint $table) {
            $table->id();
            $table->string('tentruyen');
            $table->string('slug');
            $table->string('nhomdich')->default('Không biết');
            $table->longText('mota');
            $table->string('hinhanh',255);
            $table->integer('khoa');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truyen');
    }
};
