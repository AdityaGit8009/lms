<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_attendance', function (Blueprint $table) {
            // Manual marks have null claims and can still belong to multiple batches each day.
            $table->ipAddress('qr_ip')->nullable();
            $table->unsignedBigInteger('qr_student_id')->nullable();
            $table->unique(['attend_date', 'qr_ip']);
            $table->unique(['attend_date', 'qr_student_id']);
        });
    }

    public function down(): void
    {
        Schema::table('tbl_attendance', function (Blueprint $table) {
            $table->dropUnique(['attend_date', 'qr_ip']);
            $table->dropUnique(['attend_date', 'qr_student_id']);
            $table->dropColumn(['qr_ip', 'qr_student_id']);
        });
    }
};
