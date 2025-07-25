<?php

namespace App\Http\Controllers\Task;

use App\DTO\Task\UpdateTaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateTaskFormRequest;
use App\Service\Task\UpdateTaskService;
use DateTime;

class UpdateTaskController extends Controller
{
    public function __construct(public UpdateTaskService $updateTaskService) {}

    public function __invoke(UpdateTaskFormRequest $request, int $id)
    {
        $validated = $request->validated();
        
        $dueDate = new DateTime($validated['due_date']);

        $this->updateTaskService->execute(new UpdateTaskDTO(
            $id,
            $validated['title'],
            $validated['description'],
            $dueDate->format('Y-m-d'),
            $validated['status'],
            $validated['priority'],
            $validated['user_id']
        ));

        return response()->noContent();
    }
}
