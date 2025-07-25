<?php

namespace App\Service\User;

use App\DTO\User\GetAllUsersDTO;
use App\Interfaces\User\GetAllUsersServiceInterface;
use App\Models\User;

class GetAllUsersService implements GetAllUsersServiceInterface
{
    public function execute(GetAllUsersDTO $dto): array
    {
        return User::all()->toArray();
    }
}
