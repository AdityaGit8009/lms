<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FeedbackForm extends Model
{
  protected $table = 'tbl_feedback_forms';
  protected $primaryKey = 'form_id';

  protected $fillable = [
    'public_key',
    'title',
    'description',
    'session_ids',
    'center_ids',
    'programme_ids',
    'technology_ids',
    'batch_ids',
    'form_status',
    'questions_json',
    'created_by',
  ];

  protected $casts = [
    'session_ids'    => 'array',
    'center_ids'     => 'array',
    'programme_ids'  => 'array',
    'technology_ids' => 'array',
    'batch_ids'      => 'array',
    'questions_json' => 'array',
  ];

  /** Return the matching assignment for each response dimension, or null for an ineligible form. */
  public function responseDimensions(array $assignments): ?array
  {
    $dimensions = [];
    foreach ($assignments as $dimension => $ids) {
      $scope = $this->getAttribute($dimension . '_ids') ?? [];
      $matches = array_values(array_unique(array_filter($ids)));
      if ($scope && !in_array('all', $scope, true)) {
        $matches = array_values(array_intersect($matches, $scope));
        if (!$matches) {
          return null;
        }
      }

      // Responses have one column per dimension. Multiple matches are ambiguous.
      $dimensions[$dimension . '_id'] = count($matches) === 1 ? $matches[0] : null;
    }

    return $dimensions;
  }

  public function validatedAnswers(array $input): array
  {
    $rules = [];
    $attributes = [];
    foreach ($this->questions_json as $question) {
      $key = 'answers.' . $question['uid'] . '.value';
      $options = $question['options'] ?? [];
      $rules[$key] = [
        !empty($question['required']) ? 'required' : 'nullable',
        ...match ($question['type']) {
          'checkbox' => ['array', 'list'],
          'radio', 'dropdown' => ['string', Rule::in($options)],
          'rating' => ['integer', 'between:1,5'],
          default => ['string'],
        },
      ];
      $attributes[$key] = $question['text'];

      if ($question['type'] === 'checkbox') {
        $rules[$key . '.*'] = ['string', 'distinct', Rule::in($options)];
        $attributes[$key . '.*'] = $question['text'];
      }
    }

    Validator::make(['answers' => $input], $rules, [], $attributes)->validate();

    $answers = [];
    foreach ($this->questions_json as $question) {
      $id = $question['uid'];
      $answers[$id] = [
        'question' => $question['text'],
        'type' => $question['type'],
        'value' => $input[$id]['value'] ?? null,
      ];
    }

    return $answers;
  }

  public function responses()
  {
    return $this->hasMany(FeedbackResponse::class, 'form_id', 'form_id');
  }
}
