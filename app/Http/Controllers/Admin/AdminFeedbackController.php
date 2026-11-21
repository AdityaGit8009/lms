<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminFeedbackController extends Controller
{
  public function create()
  {
    return view('Admin.Feedback.builder', [
      'form' => null,
      'sessions' => Session::orderByDesc('session_id')->get(),
    ]);
  }

  public function edit($id)
  {
    $form = FeedbackForm::findOrFail($id);

    return view('Admin.Feedback.builder', [
      'form' => $form,
      'sessions' => Session::orderByDesc('session_id')->get(),
    ]);
  }
  public function delete($id)
  {
    $form = FeedbackForm::findOrFail($id);

    $form->delete();

    return redirect()
      ->route('admin.feedback.manage')
      ->with('success', 'Feedback form deleted successfully.');
  }
  public function store(Request $request)
  {
    $validated = $this->validateForm($request);

    FeedbackForm::create([
      'public_key'      => (string) Str::uuid(),
      'title'           => $validated['title'],
      'description'     => $validated['description'] ?? null,
      'session_ids'     => $this->normalizeMulti($validated['session_ids'] ?? []),
      'center_ids'      => $this->normalizeMulti($validated['center_ids'] ?? []),
      'programme_ids'   => $this->normalizeMulti($validated['programme_ids'] ?? []),
      'technology_ids'  => $this->normalizeMulti($validated['technology_ids'] ?? []),
      'batch_ids'       => $this->normalizeMulti($validated['batch_ids'] ?? []),
      'form_status'     => $validated['form_status'],
      'questions_json'  => json_decode($validated['questions_json'], true),
      'created_by'      => Auth::id(),
    ]);

    return redirect()->route('admin.feedback.manage')->with('success', 'Feedback form created successfully.');
  }
  private function resolveNames(string $table, string $idColumn, string $nameColumn, ?array $ids): string
  {
    if (empty($ids)) {
      return '-';
    }

    if (in_array('all', $ids, true)) {
      return 'All';
    }

    $names = DB::table($table)
      ->whereIn($idColumn, $ids)
      ->pluck($nameColumn)
      ->toArray();

    return !empty($names) ? implode(', ', $names) : '-';
  }
  public function manage()
  {
    $forms = FeedbackForm::latest('form_id')->get()->map(function ($form) {
      $form->session_names = $this->resolveNames('tbl_session', 'session_id', 'session_name', $form->session_ids);
      $form->center_names = $this->resolveNames('tbl_centers', 'center_id', 'center_name', $form->center_ids);
      $form->programme_names = $this->resolveNames('tbl_programme', 'programme_id', 'programme_name', $form->programme_ids);
      $form->technology_names = $this->resolveNames('tbl_technology', 'technology_id', 'technology_name', $form->technology_ids);
      $form->batch_names = $this->resolveNames('tbl_batch', 'batch_id', 'batch_name', $form->batch_ids);
      return $form;
    });

    return view('Admin.Feedback.manage', compact('forms'));
  }

  public function responsePage($id)
  {
    $form = FeedbackForm::with('responses')->findOrFail($id);

    return view('Admin.Feedback.analytics', compact('form'));
  }
  public function copy($id)
  {
    $form = FeedbackForm::findOrFail($id);

    $newForm = $form->replicate();
    $newForm->public_key = (string) \Illuminate\Support\Str::uuid();
    $newForm->title = $form->title . ' (Copy)';
    $newForm->created_at = now();
    $newForm->updated_at = now();
    $newForm->save();

    return redirect()->route('admin.feedback.manage')
      ->with('success', 'Feedback form copied successfully.');
  }
  public function update(Request $request, $id)
  {
    $form = FeedbackForm::findOrFail($id);
    $validated = $this->validateForm($request);

    $form->update([
      'title'           => $validated['title'],
      'description'     => $validated['description'] ?? null,
      'session_ids'     => $this->normalizeMulti($validated['session_ids'] ?? []),
      'center_ids'      => $this->normalizeMulti($validated['center_ids'] ?? []),
      'programme_ids'   => $this->normalizeMulti($validated['programme_ids'] ?? []),
      'technology_ids'  => $this->normalizeMulti($validated['technology_ids'] ?? []),
      'batch_ids'       => $this->normalizeMulti($validated['batch_ids'] ?? []),
      'form_status'     => $validated['form_status'],
      'questions_json'  => json_decode($validated['questions_json'], true),
    ]);

    return redirect()->route('admin.feedback.manage')->with('success', 'Feedback form updated successfully.');
  }

  public function cascadeCenters(Request $request)
  {
    $sessionIds = $this->filterIds($request->input('session_ids', []));

    $centers = DB::table('tbl_programme_centers as pc')
      ->join('tbl_centers as c', 'c.center_id', '=', 'pc.center_id')
      ->when(!empty($sessionIds), function ($q) use ($sessionIds) {
        $q->whereIn('pc.session_id', $sessionIds);
      })
      ->select('c.center_id as id', 'c.center_name as text')
      ->distinct()
      ->orderBy('c.center_name')
      ->get();

    return response()->json([
      'success' => true,
      'data' => $centers
    ]);
  }
  private function groupCountsWithNames($responses, $column, $table, $idCol, $nameCol): array
  {
    $counts = $responses
      ->filter(fn($row) => !empty($row->{$column}))
      ->groupBy($column)
      ->map(fn($rows) => $rows->count())
      ->toArray();

    if (empty($counts)) {
      return ['labels' => [], 'values' => []];
    }

    $nameMap = DB::table($table)
      ->whereIn($idCol, array_keys($counts))
      ->pluck($nameCol, $idCol)
      ->toArray();

    $labels = [];
    $values = [];

    foreach ($counts as $id => $count) {
      $labels[] = $nameMap[$id] ?? ('ID ' . $id);
      $values[] = $count;
    }

    return [
      'labels' => $labels,
      'values' => $values,
    ];
  }
  public function overallAnalytics()
  {
    $responses = FeedbackResponse::latest('response_id')->get();

    $sessionChart = $this->groupCountsWithNames($responses, 'session_id', 'tbl_session', 'session_id', 'session_name');
    $centerChart = $this->groupCountsWithNames($responses, 'center_id', 'tbl_centers', 'center_id', 'center_name');
    $programmeChart = $this->groupCountsWithNames($responses, 'programme_id', 'tbl_programme', 'programme_id', 'programme_name');
    $technologyChart = $this->groupCountsWithNames($responses, 'technology_id', 'tbl_technology', 'technology_id', 'technology_name');
    $batchChart = $this->groupCountsWithNames($responses, 'batch_id', 'tbl_batch', 'batch_id', 'batch_name');

    return view('Admin.Feedback.overall_analytics', compact(
      'responses',
      'sessionChart',
      'centerChart',
      'programmeChart',
      'technologyChart',
      'batchChart'
    ));
  }

  public function cascadeProgrammes(Request $request)
  {
    $sessionIds = $this->filterIds($request->input('session_ids', []));
    $centerIds = $this->filterIds($request->input('center_ids', []));

    $programmes = DB::table('tbl_programme_centers as pc')
      ->join('tbl_programme as p', 'p.programme_id', '=', 'pc.programme_id')
      ->when(!empty($sessionIds), function ($q) use ($sessionIds) {
        $q->whereIn('pc.session_id', $sessionIds);
      })
      ->when(!empty($centerIds), function ($q) use ($centerIds) {
        $q->whereIn('pc.center_id', $centerIds);
      })
      ->select('p.programme_id as id', 'p.programme_name as text')
      ->distinct()
      ->orderBy('p.programme_name')
      ->get();

    return response()->json([
      'success' => true,
      'data' => $programmes
    ]);
  }

  public function cascadeTechnologies(Request $request)
  {
    $sessionIds = $this->filterIds($request->input('session_ids', []));
    $programmeIds = $this->filterIds($request->input('programme_ids', []));

    $technologies = DB::table('tbl_technology')
      ->when(!empty($sessionIds), function ($q) use ($sessionIds) {
        $q->whereIn('session_id', $sessionIds);
      })
      ->when(!empty($programmeIds), function ($q) use ($programmeIds) {
        $q->whereIn('programme_id', $programmeIds);
      })
      ->select('technology_id as id', 'technology_name as text')
      ->distinct()
      ->orderBy('technology_name')
      ->get();

    return response()->json([
      'success' => true,
      'data' => $technologies
    ]);
  }

  public function cascadeBatches(Request $request)
  {
    $sessionIds = $this->filterIds($request->input('session_ids', []));
    $programmeIds = $this->filterIds($request->input('programme_ids', []));
    $technologyIds = $this->filterIds($request->input('technology_ids', []));

    $batches = DB::table('tbl_batch')
      ->when(!empty($sessionIds), function ($q) use ($sessionIds) {
        $q->whereIn('session_id', $sessionIds);
      })
      ->when(!empty($programmeIds), function ($q) use ($programmeIds) {
        $q->whereIn('programme_id', $programmeIds);
      })
      ->when(!empty($technologyIds), function ($q) use ($technologyIds) {
        $q->whereIn('technology_id', $technologyIds);
      })
      ->select('batch_id as id', 'batch_name as text')
      ->distinct()
      ->orderBy('batch_name')
      ->get();

    return response()->json([
      'success' => true,
      'data' => $batches
    ]);
  }

  private function validateForm(Request $request): array
  {
    return $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'session_ids' => 'nullable|array',
      'center_ids' => 'nullable|array',
      'programme_ids' => 'nullable|array',
      'technology_ids' => 'nullable|array',
      'batch_ids' => 'nullable|array',
      'form_status' => 'required|in:open,close',
      'questions_json' => 'required|string',
    ]);
  }

  private function normalizeMulti(array $items): array
  {
    $items = array_values(array_filter($items, function ($v) {
      return $v !== null && $v !== '';
    }));

    if (in_array('all', $items, true)) {
      return ['all'];
    }

    return array_map('intval', $items);
  }

  private function filterIds(array $items): array
  {
    $items = array_values(array_filter($items, function ($v) {
      return $v !== null && $v !== '' && $v !== 'all';
    }));

    return array_map('intval', $items);
  }
}
