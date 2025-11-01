<?php

namespace App\Repositories\Task;

use App\DTO\Task\GetAllTasksDTO;
use App\Interfaces\Task\GetAllTasksRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class GetAllTaskRepository implements GetAllTasksRepositoryInterface
{
    public function getAll(GetAllTasksDTO $dto)
    {
        $query = Task::query();

        if ($dto->role === 'admin') {
            $query = Task::withTrashed();
        } else {
            $query->where('user_id', $dto->id);
        }

        if (
            is_null($dto->status) &&
            is_null($dto->search) &&
            is_null($dto->page) &&
            is_null($dto->perPage) &&
            $dto->searchByName === false &&
            $dto->searchByDescription === false
        ) {
            return $query->get();
        }

        if ($dto->status && $dto->status !== 'all') {
            $query->where('status', $dto->status);
        }

        if ($dto->search && ($dto->searchByName || $dto->searchByDescription)) {
            $query->where(function ($q) use ($dto) {
                if ($dto->searchByName) {
                    $q->orWhere('title', 'LIKE', "%{$dto->search}%");
                }
                if ($dto->searchByDescription) {
                    $q->orWhere('description', 'LIKE', "%{$dto->search}%");
                }
            });
        }

        return $query
            ->orderBy('created_at', 'desc')
            ->paginate($dto->perPage, ['*'], 'page', $dto->page);
    }
}
