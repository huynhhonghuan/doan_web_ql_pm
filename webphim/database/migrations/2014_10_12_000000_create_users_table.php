<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $pass = Hash::make('12345678');

        DB::table('users')->insert([
            ['name' => 'Dương Khải Duy', 'email' => 'mokeyduy@gmail.com', 'password' => $pass],
            ['name' => 'Nguyễn Tuấn Anh', 'email' => 'ntta@gmail.com', 'password' => $pass],
            ['name' => 'Người dùng', 'email' => 'nguoidung@gmail.com', 'password' => $pass],
            ['name' => 'Cộng tác viên truyện', 'email' => 'congtacvientruyen@gmail.com', 'password' => $pass],
            ['name' => 'Cộng tác viên phim', 'email' => 'congtacvienphim@gmail.com', 'password' => $pass],
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
