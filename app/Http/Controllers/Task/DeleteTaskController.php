<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Service\Task\DeleteTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $task = Task::findOrFail($id);

        if (Auth::user()->role === "admin") {
            $task->forceDelete();

            return response()->noContent();
        }

        $task->delete();

        return response()->noContent();
    }
}
