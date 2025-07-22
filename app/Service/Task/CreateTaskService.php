<?php
namespace App\Service\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Events\TaskCreatedEvent;
use App\Interfaces\Task\CreateTaskServiceInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Broadcast;

class CreateTaskService implements CreateTaskServiceInterface
{
    public function execute(CreateTaskDTO $data): array
    {
        $task = Task::create([
            'title' => $data->title,
            'description' => $data->description,
            'due_date' => $data->dueDate,
        ]);
        Broadcast(new TaskCreatedEvent($task));
        return $task->toArray();
    }
}

      

