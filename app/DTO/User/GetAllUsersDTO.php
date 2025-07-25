<?php

namespace App\DTO\User;

use App\Models\User;

class GetAllUsersDTO
{
    public function __construct(
        public readonly User $user
    ) {}
}
