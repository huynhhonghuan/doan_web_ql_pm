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
            $table->string('tentheloai', 100);
            $table->string('slug');
            $table->string('mota', 255)->nullable();
            $table->integer('khoa')->default(1);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        DB::table('theloai')->insert([
            ['tentheloai' => 'Manga', 'slug' => 'manga', 'mota' => 'Thể loại Manga'],
            ['tentheloai' => 'Action', 'slug' => 'action', 'mota' => 'Thể loại Action'],
            ['tentheloai' => 'Chuyển sinh', 'slug' => 'chuyen-sinh', 'mota' => 'Thể loại chuyển sinh'],
            ['tentheloai' => 'Đam mỹ', 'slug' => 'dam-my', 'mota' => 'Thể loại đam mỹ'],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theloai');
    }
};
