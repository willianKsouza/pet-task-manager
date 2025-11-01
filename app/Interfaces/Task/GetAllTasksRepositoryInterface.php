<?php

namespace App\Interfaces\Task;

use App\DTO\Task\GetAllTasksDTO;
use Illuminate\Database\Eloquent\Collection;

interface GetAllTasksRepositoryInterface
{
    /**
     * @return Task[]
     */
    public function getAll(GetAllTasksDTO $dto);
}
