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
        Schema::create('vaitro', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('tenvaitro');
            $table->string('mota')->nullable();
            $table->string('ghichu')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        DB::table('vaitro')->insert([
            ['id' => 'admin', 'tenvaitro' => 'Quản trị viên', 'mota' => 'Quản trị viên là người quản lý hệ thống với các quyền xem, thêm, xóa, sửa, thống kê và báo cáo'],
            ['id' => 'nd', 'tenvaitro' => 'Người dùng', 'mota' => 'Người dùng được phép đăng ký tài khoản, xem truyện-phim, lưu-thích-đánh giá truyện và phim'],
            ['id' => 'ctvt', 'tenvaitro' => 'Cộng tác viên truyện', 'mota' => 'Cộng tác viên chỉ được phép đăng truyên và tương tác với truyện.'],
            ['id' => 'ctvp', 'tenvaitro' => 'Cộng tác viên phim', 'mota' => 'Cộng tác viên chỉ được phép đăng phim và tương tác với phim.']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaitro');
    }
};
