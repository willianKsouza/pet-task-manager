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
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['to_do', 'in_progress', 'in_review', 'done']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Task $task) {
            // Associa de 1 a 3 usuários aleatórios (dentre os 9 existentes)
            $userIds = User::inRandomOrder()->limit(rand(1, 2))->pluck('id');
            $task->users()->attach($userIds);
        });
    }
}
