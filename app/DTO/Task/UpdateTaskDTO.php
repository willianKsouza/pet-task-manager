<?php

namespace App\DTO\Task;

class UpdateTaskDTO
{
    public function __construct(
        public string $id,
        public ?string $title,
        public ?string $description,
        public ?string $dueDate,
        public ?string $status,
        public ?string $priority,
        public int $user_id
    ) {
    }
}