<?php

namespace App\Service\Task;

use App\DTO\Task\GetAllTasksDTO;
use App\Interfaces\Task\GetAllTasksRepositoryInterface;

class GetAllTasksService
{
    public function __construct(private GetAllTasksRepositoryInterface $getAllTasksRepository) {}

    public function execute(GetAllTasksDTO $dto)
    {
        $tasks = $this->getAllTasksRepository->getAll($dto);

        return $tasks;
    }
}
