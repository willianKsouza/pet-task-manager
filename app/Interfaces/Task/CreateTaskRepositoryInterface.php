<?php

namespace App\Interfaces\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Models\Task;

interface CreateTaskRepositoryInterface
{
    public function create(CreateTaskDTO $dto): Task;
}