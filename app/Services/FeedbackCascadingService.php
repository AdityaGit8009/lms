<?php

namespace App\Services;

use App\Models\Batch;
use App\Models\Center;
use App\Models\Programme;
use App\Models\Session;
use App\Models\Technology;
use Illuminate\Support\Facades\DB;

class FeedbackCascadingService
{
  public function sessions()
  {
    return Session::orderByDesc('session_id')->get();
  }

  public function centersBySession(?array $sessionIds = null)
  {
    $query = DB::table('tbl_programme_centers as pc')
      ->join('tbl_centers as c', 'c.center_id', '=', 'pc.center_id')
      ->select('c.center_id', 'c.center_name')
      ->distinct()
      ->orderBy('c.center_name');

    if ($sessionIds && !in_array('all', $sessionIds)) {
      $query->whereIn('pc.session_id', $sessionIds);
    }

    return $query->get();
  }

  public function programmes(?array $sessionIds = null, ?array $centerIds = null)
  {
    $query = DB::table('tbl_programme_centers as pc')
      ->join('tbl_programme as p', 'p.programme_id', '=', 'pc.programme_id')
      ->select('p.programme_id', 'p.programme_name')
      ->distinct()
      ->orderBy('p.programme_name');

    if ($sessionIds && !in_array('all', $sessionIds)) {
      $query->whereIn('pc.session_id', $sessionIds);
    }

    if ($centerIds && !in_array('all', $centerIds)) {
      $query->whereIn('pc.center_id', $centerIds);
    }

    return $query->get();
  }

  public function technologies(?array $sessionIds = null, ?array $programmeIds = null)
  {
    $query = Technology::query()
      ->select('technology_id', 'technology_name')
      ->orderBy('technology_name');

    if ($sessionIds && !in_array('all', $sessionIds)) {
      $query->whereIn('session_id', $sessionIds);
    }
    if ($programmeIds && !in_array('all', $programmeIds)) {
      $query->whereIn('programme_id', $programmeIds);
    }

    return $query->get();
  }

  public function batches(?array $sessionIds = null, ?array $programmeIds = null, ?array $technologyIds = null)
  {
    $query = Batch::query()
      ->select('batch_id', 'batch_name')
      ->orderBy('batch_name');

    if ($sessionIds && !in_array('all', $sessionIds)) {
      $query->whereIn('session_id', $sessionIds);
    }

    if ($programmeIds && !in_array('all', $programmeIds)) {
      $query->whereIn('programme_id', $programmeIds);
    }

    if ($technologyIds && !in_array('all', $technologyIds)) {
      $query->whereIn('technology_id', $technologyIds);
    }

    return $query->get();
  }
}
