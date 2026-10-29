<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('tbl_feedback_responses')) {
            Schema::create('tbl_feedback_responses', function (Blueprint $table) {
                $table->bigIncrements('response_id');
                $table->unsignedBigInteger('form_id');
                $table->unsignedBigInteger('student_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('session_id')->nullable();
                $table->unsignedBigInteger('center_id')->nullable();
                $table->unsignedBigInteger('programme_id')->nullable();
                $table->unsignedBigInteger('technology_id')->nullable();
                $table->unsignedBigInteger('batch_id')->nullable();
                $table->string('student_name')->nullable();
                $table->string('email')->nullable();
                $table->string('mobile')->nullable();
                $table->json('answers_json');
                $table->timestamps();

                $table->index(['form_id']);
                $table->index(['student_id']);
                $table->index(['session_id']);
                $table->index(['center_id']);
                $table->index(['programme_id']);
                $table->index(['technology_id']);
                $table->index(['batch_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_feedback_responses');
    }
};
