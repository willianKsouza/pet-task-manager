<?php

namespace App\Http\Controllers\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskFormRequest;
use App\Service\Task\CreateTaskService;
use Carbon\Carbon;

class CreateTaskController extends Controller
{

    public function __construct(public CreateTaskService $createTaskService) {}

    public function __invoke(CreateTaskFormRequest $request)
    {
        
        $validated = $request->validated();

        $dto = new CreateTaskDTO(
            $validated['title'],
            $validated['description'],
            $validated['due_date'],
            $validated['status'],
            $validated['priority'],
            $validated['user_id'],
            $request->user()->id
        );


        $task = $this->createTaskService->execute($dto);
    
        return response()->json([
            'data' => $task->toResource()
        ], 201);
    }
}
