<?php

namespace App\Service\Task;

use App\DTO\Task\UpdateTaskDTO;
use App\Models\Task;

class UpdateTaskService
{
    public function execute(UpdateTaskDTO $dto): array
    {
        $task = Task::findOrFail($dto->id);
     
        $dtoData = [
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->dueDate,
            'status' => $dto->status,
            'priority' => $dto->priority,
            'user_id' => $dto->user_id,
        ];
   
        $updates = collect($dtoData)->filter(function ($value, $key) use ($task) {
            return $task->{$key} !== $value;
        });

        if ($updates->isNotEmpty()) {
            $task->update($updates->all());
        }

        return $task->toArray();
    }
}
