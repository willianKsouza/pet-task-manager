<?php

namespace App\Http\Controllers\Task;

use App\DTO\Task\GetAllTasksDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\Request;
use App\Service\Task\GetAllTasksService;

class GetAllTaskController extends Controller
{
    public function __construct(
        public GetAllTasksService $getAllTasksService
    ) {}
    //TODO preciso validar os dados da request com um formRequest antes de fazer os testes
    public function __invoke(Request $request)
    {
        $dto = new GetAllTasksDTO(
            $request->user()->role,
            $request->user()->id,
            $request->input('status'),
            $request->input('search'),
            $request->boolean('searchByName'),
            $request->boolean('searchByDescription'),
            $request->input('page'),
            $request->input('perPage')
        );

        $tasks = $this->getAllTasksService->execute($dto);
     
        return response()->json($tasks);
    }
}
