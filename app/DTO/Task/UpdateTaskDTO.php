<?php

namespace App\DTO\Task;

class UpdateTaskDTO
{
    public function __construct(
        public int $id,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $due_date = null,
        public ?string $status = null,
        public ?string $priority = null,
        public ?int $user_id = null,
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            $id,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['due_date'] ?? null,
            $data['status'] ?? null,
            $data['priority'] ?? null,
            $data['user_id'] ?? null,
        );
    }
}