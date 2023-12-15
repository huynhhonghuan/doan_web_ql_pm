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
        Schema::table('truyen', function (Blueprint $table) {
            $table->foreignId('theloai_id')->constrained('theloai')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tacgia_id')->constrained('tacgia')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('quocgia_id')->constrained('quocgia')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('truyen', function (Blueprint $table) {
            $table->dropForeign('truyen_theloai_id_foreign');
            $table->dropForeign('truyen_tacgia_id_foreign');
            $table->dropForeign('truyen_quocgia_id_foreign');
            $table->dropForeign('truyen_user_id_foreign');
        });
    }
};
