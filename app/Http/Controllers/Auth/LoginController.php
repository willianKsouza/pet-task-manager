<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Models\User;
use App\Service\Auth\LoginService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $loginService
    ) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginFormRequest $request)
    {
        try {
            $response = $this->loginService->execute($request);

            return response()->json($response, 200);
            
        } catch (AuthenticationException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
