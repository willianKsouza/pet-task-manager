<?php

namespace App\Service\Dashboard;

use App\Models\Task;
use App\Models\User;

class DashboardService
{

    public function execute()
    {

        $totalTasks = Task::count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $doneTasks = Task::where('status', 'done')->count();
        $teamMembers = User::where('is_active', true)->count();


        $teamPerformance = User::where('is_active', true)
            ->withCount(['tasks as tasks_done_count' => function ($query) {
                $query->where('status', 'done');
            }])
            ->orderBy('tasks_done_count', 'desc')
            ->take(10)
            ->get(['id', 'name', 'role']);

        return [
            'stats' => [
                'total_tasks' => $totalTasks,
                'in_progress_tasks' => $inProgressTasks,
                'done_tasks' => $doneTasks,
                'team_members' => $teamMembers,
            ],
            'team_performance' => $teamPerformance,
        ];
    }
}
