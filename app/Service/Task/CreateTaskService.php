<?php

namespace App\Service\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Events\TaskCreatedEvent;
use App\Interfaces\Task\CreateTaskRepositoryInterface;
use App\Models\Task;


class CreateTaskService
{
    public function __construct(private CreateTaskRepositoryInterface $createTaskRepository) {}

    public function execute(CreateTaskDTO $dto): Task
    {
        $task = $this->createTaskRepository->create($dto);
        
        broadcast(new TaskCreatedEvent($task));

        return $task;
    }
}
