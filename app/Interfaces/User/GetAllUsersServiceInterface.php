<?php 

namespace App\Interfaces\User;

use App\DTO\User\GetAllUsersDTO;

interface GetAllUsersServiceInterface
{
    public function execute(GetAllUsersDTO $dto): array;
}
