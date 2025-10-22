<?php

namespace App\DTO\Task;
class CreateTaskDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $due_date,
        public string $status,
        public string $priority,
        public int $user_id,
        public int $created_by
    ) {}
}
