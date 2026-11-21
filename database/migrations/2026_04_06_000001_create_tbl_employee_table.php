<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tbl_employee')) {
            return;
        }

        Schema::create('tbl_employee', function (Blueprint $table) {
            $table->id('emp_id');
            $table->integer('emp_role')->default(5);
            $table->string('emp_name', 200);
            $table->string('emp_regid', 50)->unique();
            $table->unsignedBigInteger('center_id');
            $table->string('emp_mobile', 10)->unique();
            $table->string('emp_email', 100)->unique();
            $table->text('emp_password')->nullable();
            $table->enum('emp_gender', ['Male', 'Female', 'Other']);
            $table->enum('emp_type', ['Internal', 'External']);
            $table->string('emp_pic')->nullable();
            $table->enum('del_status', ['N', 'Y'])->default('N');
            $table->enum('is_block', ['N', 'Y'])->default('N');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->index('center_id');
        });
    }

    public function down(): void
    {
        // Some existing databases recorded the later copy as the table's owner.
        if (DB::table(config('database.migrations.table'))->where('migration', '2026_04_06_112436_create_tbl_employee_table')->exists()) {
            return;
        }

        Schema::dropIfExists('tbl_employee');
    }
};
