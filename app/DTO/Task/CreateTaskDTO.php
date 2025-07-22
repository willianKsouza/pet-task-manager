<?php

namespace App\DTO\Task;

use DateTimeInterface;

class CreateTaskDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public DateTimeInterface $dueDate
    ) {
    }
}
