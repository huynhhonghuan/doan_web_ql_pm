<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('role_id',5)->index();
            $table->foreign('role_id')->references('id')->on('role')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        DB::table('user_role')->insert([
            ['user_id'=> 1, 'role_id'=>'admin'],
            ['user_id'=> 2, 'role_id'=>'admin'],
            ['user_id'=> 3, 'role_id'=>'nd'],
            ['user_id'=> 4, 'role_id'=>'ctvt'],
            ['user_id'=> 5, 'role_id'=>'ctvp'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
