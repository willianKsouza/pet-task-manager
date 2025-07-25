<?php

namespace App\Http\Controllers\Task;

use App\DTO\Task\GetAllTasksDTO;
use App\Interfaces\Task\GetAllTasksServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetAllTaskController extends Controller
{
    public function __construct(
        public GetAllTasksServiceInterface $getAllTasksService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $dto = new GetAllTasksDTO(
            $request->user()->role,
            $request->user()->id
        );

        $tasks = $this->getAllTasksService->execute($dto);

        return response()->json($tasks);
    }
}
