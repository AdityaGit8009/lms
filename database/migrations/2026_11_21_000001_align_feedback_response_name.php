<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('tbl_feedback_responses', 'name') && !Schema::hasColumn('tbl_feedback_responses', 'student_name')) {
            Schema::table('tbl_feedback_responses', function (Blueprint $table) {
                $table->renameColumn('name', 'student_name');
            });
        }
    }
};
