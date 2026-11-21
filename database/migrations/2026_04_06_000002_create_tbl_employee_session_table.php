<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tbl_employee_session')) {
            return;
        }

        Schema::create('tbl_employee_session', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('session_id');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->unique(['emp_id', 'session_id']);
        });
    }

    public function down(): void
    {
        // Some existing databases recorded the later copy as the table's owner.
        if (DB::table(config('database.migrations.table'))->where('migration', '2026_04_06_112604_create_tbl_employee_session_table')->exists()) {
            return;
        }

        Schema::dropIfExists('tbl_employee_session');
    }
};
