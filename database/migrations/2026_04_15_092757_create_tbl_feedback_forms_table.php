<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tbl_feedback_forms')) {
            return;
        }

        Schema::create('tbl_feedback_forms', function (Blueprint $table) {
            $table->id('form_id');
            $table->uuid('public_key')->unique('lms_feedback_forms_public_key');
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('session_ids')->nullable();
            $table->json('center_ids')->nullable();
            $table->json('programme_ids')->nullable();
            $table->json('technology_ids')->nullable();
            $table->json('batch_ids')->nullable();
            $table->enum('form_status', ['open', 'close'])->default('close');
            $table->json('questions_json');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Preserve installations that supplied their own forms table before this migration.
        if (Schema::hasTable('tbl_feedback_forms') && Schema::hasIndex('tbl_feedback_forms', 'lms_feedback_forms_public_key')) {
            Schema::drop('tbl_feedback_forms');
        }
    }
};
