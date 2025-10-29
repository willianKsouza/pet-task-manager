<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateTaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_return_json_with_valid_data()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $due_date = Carbon::now()->addDays()->format('Y-m-d H:i:s');

        $body = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => $due_date,
            'status' => 'to_do',
            'priority' => 'high',
            'user_id' => $user->id,
            'created_by' => $user->id,
        ];

        $response = $this->postJson('/api/task/create', $body);

        $response
            ->assertStatus(201)
            ->assertJson(
                function (AssertableJson $json) use ($due_date, $user, $body) {
                    $json
                        ->where('data.id', 1)
                        ->where('data.title', $body['title'])
                        ->where('data.description', $body['description'])
                        ->where('data.due_date', $due_date)
                        ->where('data.status', $body['status'])
                        ->where('data.priority', $body['priority'])
                        ->where('data.user_id', $user->id)
                        ->where('data.created_by', $user->id)
                        ->missing('data.deleted_at')
                        ->missing('data.updated_at')
                        ->etc();
                }
            );
    }

    public function test_exception_with_invalid_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $future_date = now()->addDays()->format('Y-m-d H:i:s');

        $body = [
            'title' => '',
            'description' => '',
            'due_date' => $future_date,
            'status' => 'to_do',
            'priority' => 'high',
            'user_id' => $user->id,
            'created_by' => $user->id,
        ];

        $response = $this->postJson('/api/task/create', $body);

        $response
            ->assertStatus(422)
            ->assertJsonPath('error.message', 'The provided data is invalid.');
    }

    public function test_exception_with_db_is_down(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $future_date = now()->addDays(1)->format('Y-m-d H:i:s');

        $body = [
            'title' => 'task 1',
            'description' => 'description 1',
            'due_date' => $future_date,
            'status' => 'to_do',
            'priority' => 'high',
            'user_id' => $user->id,
            'created_by' => $user->id,
        ];

        DB::shouldReceive('connection')
            ->andThrow(new QueryException('', '', [], new \Exception));

        $response = $this->postJson('/api/task/create', $body);

        $response
            ->assertStatus(503)
            ->assertJsonPath('error.message', 'A database error occurred. Please try again later.');
    }
}
