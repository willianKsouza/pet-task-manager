<?php

namespace App\Http\Controllers\Task;

use App\DTO\Task\CreateTaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskFormRequest;
use App\Interfaces\Task\CreateTaskServiceInterface;
use DateTime;
use Illuminate\Http\Request;

class CreateTaskController extends Controller
{

    public function __construct(public CreateTaskServiceInterface $createTaskService) {}

    public function __invoke(CreateTaskFormRequest $request)
    {
        $data = $request->validated();

        $task = $this->createTaskService->execute(new CreateTaskDTO(
            title: $data['title'],
            description: $data['description'],
            dueDate: new DateTime($data['due_date'])
        ));

        return response('', 201);
    }
}
