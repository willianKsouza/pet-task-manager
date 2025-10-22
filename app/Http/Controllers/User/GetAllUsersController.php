<?php

namespace App\Http\Controllers\User;

use App\DTO\User\GetAllUsersDTO;
use App\Http\Controllers\Controller;
use App\Interfaces\User\GetAllUsersServiceInterface;
use Illuminate\Http\Request;

class GetAllUsersController extends Controller
{
    public function __construct(
        public GetAllUsersServiceInterface $getAllTasksService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $dto = new GetAllUsersDTO(
            $request->user()->role,
            $request->user()->id
        );

        $tasks = $this->getAllTasksService->execute($dto);

        return response()->json($tasks);
    }
}
