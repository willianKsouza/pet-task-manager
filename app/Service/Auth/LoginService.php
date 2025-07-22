<?php

namespace App\Service\Auth;

use App\Interfaces\Auth\AuthLoginServiceInterface;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginService implements AuthLoginServiceInterface
{
    public function execute(LoginFormRequest $request): array
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('Invalid credentials');
        }

        $request->session()->regenerate();

        return [
            'user' => Auth::user(),
            'message' => 'Login successful',
        ];
    }
}
