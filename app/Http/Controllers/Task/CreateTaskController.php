<?php

namespace App\Http\Controllers\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskFormRequest;
use App\Service\Task\CreateTaskService;
use DateTime;
use Illuminate\Support\Facades\Log;

class CreateTaskController extends Controller
{

    public function __construct(public CreateTaskService $createTaskService) {}

    public function __invoke(CreateTaskFormRequest $request)
    {
        $validated = $request->validated();

        $dueDate = new DateTime($validated['due_date']);

        $this->createTaskService->execute(new CreateTaskDTO(
            $validated['title'],
            $validated['description'],
            $dueDate->format('Y-m-d'),
            $validated['status'],
            $validated['priority'],
            $validated['user_id'],
            $request->user()->id
        ));

        return response('', 201);
    }
}
