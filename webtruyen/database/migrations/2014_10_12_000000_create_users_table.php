<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 100);
            $table->string('sdt', 10)->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active');
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        $pass = Hash::make('12345678');

        DB::table('users')->insert([
            ['name' => 'Huỳnh Hồng Huân', 'username' => 'huynhhonghuan3', 'sdt' => '0374692834', 'email' => 'huynhhonghuan3@gmail.com', 'password' => $pass],
            ['name' => 'Nguyễn Thị Tường Dân', 'username' => 'nttuongdan020302', 'sdt' => '0332543351', 'email' => 'nttuongdan020302@gmail.com', 'password' => $pass],
            ['name' => 'Người dùng', 'username' => 'nguoidung', 'sdt' => '0123456799', 'email' => 'nguoidung@gmail.com', 'password' => $pass],
            ['name' => 'Cộng tác viên truyện', 'username' => 'congtacvientruyen', 'sdt' => '0123456789', 'email' => 'congtacvientruyen@gmail.com', 'password' => $pass],
            ['name' => 'Cộng tác viên phim', 'username' => 'congtacvienphim', 'sdt' => '0123456788', 'email' => 'congtacvienphim@gmail.com', 'password' => $pass],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
