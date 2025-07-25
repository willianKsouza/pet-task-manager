<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'in_review', 'done']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'user_id' => User::factory(),
            'created_by' => User::factory()
        ];
    }
}
