<?php

namespace App\Interfaces\Auth;

use App\Http\Requests\Auth\LoginFormRequest;

interface AuthLoginServiceInterface
{
    public function execute(LoginFormRequest $request): array;
}
