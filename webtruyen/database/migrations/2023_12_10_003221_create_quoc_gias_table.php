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
        Schema::create('quocgia', function (Blueprint $table) {
            $table->id();
            $table->string('tenquocgia', 100);
            $table->string('slug');
            $table->string('mota', 255)->nullable();
            $table->integer('khoa')->default(1);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        DB::table('quocgia')->insert([
            ['tenquocgia' => 'Việt Nam', 'slug' => 'viet-nam', 'mota' => 'Khu vực châu Á - Thái Bình Dương'],
            ['tenquocgia' => 'Nhật Bản', 'slug' => 'nhat-ban', 'mota' => 'Khu vực châu Á - Thái Bình Dương'],
            ['tenquocgia' => 'Hàn quốc', 'slug' => 'han-quoc', 'mota' => 'Khu vực châu Á - Thái Bình Dương'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quocgia');
    }
};
