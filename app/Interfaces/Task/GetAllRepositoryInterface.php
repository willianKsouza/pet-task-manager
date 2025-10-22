<?php

use App\DTO\Task\GetAllTasksDTO;

interface GetAllTasksServiceInterface
{
    /**
     * @return Task[]
     */
    public function execute(GetAllTasksDTO $dto): array;
}
