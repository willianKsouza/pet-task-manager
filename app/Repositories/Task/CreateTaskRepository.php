<?php

namespace App\Repositories\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Interfaces\Task\CreateTaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CreateTaskRepository implements CreateTaskRepositoryInterface
{
    public function create(CreateTaskDTO $dto): Task
    {
        return Task::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->dueDate,
            'status' => $dto->status,
            'priority' => $dto->priority,
            'user_id' => $dto->user_id,
            'created_by' => $dto->created_by,
        ]);
    }
}
