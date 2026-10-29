<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackResponse extends Model
{
    protected $table = 'tbl_feedback_responses';
    protected $primaryKey = 'response_id';

    protected $fillable = [
        'form_id',
        'student_id',
        'user_id',
        'username',
        'name',
        'email',
        'respondent_email',
        'mobile',
        'session_id',
        'center_id',
        'programme_id',
        'technology_id',
        'batch_id',
        'answers_json',
    ];

    protected $casts = [
        'answers_json' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(FeedbackForm::class, 'form_id', 'form_id');
    }
}
