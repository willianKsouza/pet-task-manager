<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_return_json_with_valid_data()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $future_date = now()->addDays(1)->format('Y-m-d');

        $body = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => $future_date,
            'status' => 'to_do',
            'priority' => 'high',
            'user_id' => $user->id,
            'created_by' => $user->id,
        ];

        $response = $this->postJson('/api/task/create', $body);

        $response
            ->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonPath('data.title', 'Test Task')
            ->assertJsonFragment([
                'title' => 'Test Task',
            ]);
    }

    public function test_exception_with_invalid_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $future_date = now()->addDays(1)->format('Y-m-d H:i:s');
        dump($future_date);
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
            ->assertJsonFragment([
                'field' => 'title',
                'message' => 'The title field is required.',
            ]);

    }
}
