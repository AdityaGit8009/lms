<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_attendance', function (Blueprint $table) {
            $table->string('attend_session', 30)->default('')->after('attend_date');
            $table->string('attend_center', 30)->default('')->after('attend_session');
            $table->string('attend_programme', 30)->default('')->after('attend_center');

            $table->index('attend_session', 'idx_attend_session');
            $table->index('attend_center', 'idx_attend_center');
            $table->index('attend_programme', 'idx_attend_programme');
            $table->index(['attend_session', 'attend_center', 'attend_programme'], 'idx_session_center_programme');
        });

        DB::statement("
            UPDATE tbl_attendance
            SET attend_session = (SELECT session_id FROM tbl_batch WHERE batch_id = tbl_attendance.attend_batch),
                attend_programme = (SELECT programme_id FROM tbl_batch WHERE batch_id = tbl_attendance.attend_batch),
                attend_center = COALESCE(
                    (SELECT center_id FROM tbl_student WHERE stu_id = tbl_attendance.attend_student),
                    attend_center
                )
            WHERE (attend_session = '' OR attend_center = '' OR attend_programme = '')
              AND EXISTS (SELECT 1 FROM tbl_batch WHERE batch_id = tbl_attendance.attend_batch)
              AND EXISTS (SELECT 1 FROM tbl_student WHERE stu_id = tbl_attendance.attend_student)
        ");
    }

    public function down(): void
    {
        Schema::table('tbl_attendance', function (Blueprint $table) {
            $table->dropIndex('idx_attend_session');
            $table->dropIndex('idx_attend_center');
            $table->dropIndex('idx_attend_programme');
            $table->dropIndex('idx_session_center_programme');

            $table->dropColumn([
                'attend_session',
                'attend_center',
                'attend_programme'
            ]);
        });
    }
};
