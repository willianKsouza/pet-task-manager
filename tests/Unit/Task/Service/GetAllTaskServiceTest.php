<?php

namespace Tests\Unit;

use App\DTO\Task\GetAllTasksDTO;
use App\Interfaces\Task\GetAllTasksRepositoryInterface;
use App\Service\Task\GetAllTasksService;
use Tests\TestCase;
use Mockery;

class GetAllTaskServicTest extends TestCase
{
    public function test_repository_is_called(): void
    {
        $dto = [
            'admin',
            2,
            'all',
            'Test Task',
            true,
            false,
            1,
            10,
        ];

        $mock_repository = Mockery::mock(GetAllTasksRepositoryInterface::class);

        $mock_repository->shouldReceive('getAll')
            ->once()
            ->with($dto)
            ->andReturn('$tasks');

        $service = new GetAllTasksService($mock_repository);

        // $paginator_data = $service->execute($dto);

     

    }
}
