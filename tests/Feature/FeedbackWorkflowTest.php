<?php

namespace Tests\Feature;

use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use App\Models\RegisterStudent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FeedbackWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_approval_form_submission_and_reporting_use_the_same_identity(): void
    {
        $this->seed();
        $password = bin2hex(random_bytes(9));
        $email = 'learner@example.test';
        $this->postJson(route('api.register'), [
            'name' => 'Test Learner', 'college' => 'Example College', 'regno' => 'TEST102',
            'course' => '1', 'branch' => '1', 'year' => '1', 'mobile' => '9876500102',
            'email' => $email, 'gender' => 'male', 'pro' => '1', 'location' => 'House',
            'password' => $password,
        ])->assertCreated();
        $this->postJson(route('api.login'), compact('email', 'password'))->assertForbidden();

        $admin = User::create(['name' => 'Form Owner', 'email' => 'owner@example.test',
            'role' => 'admin', 'password' => Hash::make(bin2hex(random_bytes(12)))]);
        $registration = RegisterStudent::where('email', $email)->firstOrFail();
        $this->actingAs($admin)->post(route('admin.approvals.updateStatus', $registration), [
            'approval_status' => 'Approved',
        ])->assertRedirect(route('admin.approvals'));
        $this->get(route('admin.feedback.create'))->assertOk();

        $definition = [
            ['uid' => 'score', 'text' => 'Course rating', 'type' => 'rating', 'required' => true],
            ['uid' => 'topics', 'text' => 'Preferred topics', 'type' => 'checkbox',
                'options' => ['Design', 'Testing'], 'required' => false],
        ];
        $payload = ['title' => 'Course review', 'form_status' => 'open'];
        $this->postJson(route('admin.feedback.store'), $payload + ['questions_json' => '[]'])
            ->assertUnprocessable()->assertJsonValidationErrors('questions');
        $this->post(route('admin.feedback.store'), $payload + ['questions_json' => json_encode($definition)])
            ->assertRedirect(route('admin.feedback.manage'));
        $form = FeedbackForm::firstOrFail();
        $this->get(route('admin.feedback.manage'))->assertOk()->assertSee('Course review');
        $this->get(route('admin.feedback.edit', $form))->assertOk();
        $this->get(route('admin.feedback.response.page', $form))->assertOk()->assertSee('No responses yet.');
        $this->postJson(route('api.logout'))->assertOk();

        $this->postJson(route('api.login'), compact('email', 'password'))->assertOk();
        $this->get(route('student.feedback.index'))->assertOk()->assertSee('Course review');
        $this->get(route('student.feedback.show', $form))->assertOk()->assertSee('Course rating');
        $this->postJson(route('student.feedback.store', $form), ['answers' => [
            'topics' => ['value' => ['Unlisted']],
        ]])->assertUnprocessable()->assertJsonValidationErrors(['answers.score.value', 'answers.topics.value.0']);
        $this->assertDatabaseCount('tbl_feedback_responses', 0);

        $this->post(route('student.feedback.store', $form), ['answers' => [
            'score' => ['value' => '4', 'question' => 'Client label'],
            'topics' => ['value' => ['Testing']],
        ]])->assertRedirect(route('student.feedback.index'));
        $response = FeedbackResponse::firstOrFail();
        $this->assertSame('Test Learner', $response->student_name);
        $this->assertSame('Course rating', $response->answers_json['score']['question']);
        $this->assertSame(['Testing'], $response->answers_json['topics']['value']);

        $this->actingAs($admin)->get(route('admin.feedback.response.page', $form))->assertOk()
            ->assertSee('Test Learner')->assertSee('Testing');
        $this->get(route('admin.feedback.overall.analytics'))->assertOk()->assertSee('Test Learner');
        $this->post(route('admin.feedback.delete', $form))->assertRedirect(route('admin.feedback.manage'));
        $this->assertDatabaseCount('tbl_feedback_responses', 0);
    }

    public function test_audience_and_status_apply_to_listing_direct_views_and_submissions(): void
    {
        $user = User::create(['name' => 'Learner', 'email' => 'scoped@example.test',
            'role' => 'student', 'password' => Hash::make(bin2hex(random_bytes(12)))]);
        RegisterStudent::create([
            'name' => $user->name, 'college' => 'Example College', 'regno' => 'TEST103',
            'course' => '1', 'branch' => '1', 'year' => '1', 'mobile' => '9876500103',
            'email' => $user->email, 'gender' => 'male', 'program' => '1',
            'location' => 'House', 'password' => $user->password, 'approval_status' => 'Approved',
        ]);
        $this->actingAs($user);
        foreach ([['close', []], ['open', [99]]] as [$status, $scope]) {
            $form = FeedbackForm::create(['public_key' => fake()->uuid(), 'title' => 'Restricted review',
                'form_status' => $status, 'center_ids' => $scope, 'questions_json' => []]);
            $this->get(route('student.feedback.index'))->assertOk()->assertDontSee('Restricted review');
            $this->get(route('student.feedback.show', $form))->assertNotFound();
            $this->post(route('student.feedback.store', $form))->assertNotFound();
        }
        $this->assertDatabaseCount('tbl_feedback_responses', 0);
    }
}
