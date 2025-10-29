<?php

namespace Tests\Unit;

use App\DTO\Task\CreateTaskDTO;
use App\Events\TaskCreatedEvent;
use App\Interfaces\Task\CreateTaskRepositoryInterface;
use App\Models\Task;
use App\Service\Task\CreateTaskService;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class CreateTaskServiceTest extends TestCase
{
    public function test_create_task_with_valid_data(): void
    {
        Event::fake();

        $future_date = now()->addDay()->format('Y-m-d H:i:s');

        $dto = new CreateTaskDTO(
            'Test Task',
            'Test Description',
            $future_date,
            'pending',
            'high',
            2,
            2
        );

        $expectedTask = new Task([
            'id' => 2,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => $future_date,
            'status' => 'pending',
            'priority' => 'high',
            'user_id' => 2,
            'created_by' => 2,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => now()->format('Y-m-d H:i:s'),
            'deleted_at' => null,
        ]);

        $mock = Mockery::mock(CreateTaskRepositoryInterface::class);

        $mock->shouldReceive('create')
            ->once()
            ->with($dto)
            ->andReturn($expectedTask);

        $service = new CreateTaskService($mock);

        $data = $service->execute($dto);
        $this->assertEquals($dto->title, $data->title);
        $this->assertEquals($dto->description, $data->description);
        $this->assertEquals($dto->due_date, $data->due_date);
        $this->assertEquals($dto->status, $data->status);
    }

    public function test_task_created_event_is_dispatched(): void
    {
        Event::fake();

        $future_date = now()->addDay()->format('Y-m-d H:i:s');

        $dto = new CreateTaskDTO(
            'Test Task',
            'Test Description',
            $future_date,
            'pending',
            'high',
            2,
            2
        );

        $expectedTask = new Task([
            'id' => 2,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => $future_date,
            'status' => 'pending',
            'priority' => 'high',
            'user_id' => 2,
            'created_by' => 2,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => now()->format('Y-m-d H:i:s'),
            'deleted_at' => null,
        ]);

        $mock = Mockery::mock(CreateTaskRepositoryInterface::class);

        $mock->shouldReceive('create')
            ->with($dto)
            ->andReturn($expectedTask);

        $service = new CreateTaskService($mock);

        $service->execute($dto);

        Event::assertDispatched(TaskCreatedEvent::class);

        Event::assertDispatchedTimes(TaskCreatedEvent::class, 1);
    }
}
