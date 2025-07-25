<?php

namespace App\DTO\Task;

class GetAllTasksDTO
{
    public function __construct(
        public readonly string $role,
        public readonly int $id,
        public readonly ?string $status = null,
        public readonly ?string $search = null,
        public readonly bool $searchByName = false,
        public readonly bool $searchByDescription = false,
        public readonly ?int $page = 1,
        public readonly ?int $perPage = 9,
    ) {}
}