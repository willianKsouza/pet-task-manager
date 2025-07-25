<?php

namespace App\Service\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Events\TaskCreatedEvent;
use App\Interfaces\Task\CreateTaskServiceInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class CreateTaskService
{
    public function execute(CreateTaskDTO $dto): array
    {
        $task = Task::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->dueDate,
            'status' => $dto->status,
            'priority' => $dto->priority,
            'user_id' => $dto->user_id,
            'created_by' => Auth::user()->id,
        ]);
        
        broadcast(new TaskCreatedEvent($task));

        return $task->toArray();
    }
}
