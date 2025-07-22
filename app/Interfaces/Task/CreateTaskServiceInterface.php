<?php

namespace App\Interfaces\Task;

use App\DTO\Task\CreateTaskDTO;

interface CreateTaskServiceInterface
{
    public function execute(CreateTaskDTO $data): array;
}
