<?php

namespace App\DTO\Task;

class GetAllTasksDTO
{
    public function __construct(
        public string $role,
        public int $id,
        public ?string $status = null,
        public ?string $search = null,
        public bool $searchByName = false,
        public bool $searchByDescription = false,
        public ?int $page = 1,
        public ?int $perPage = 9,
    ) {}
}