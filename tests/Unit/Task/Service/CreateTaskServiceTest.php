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
    /**
     * A basic test example.
     */
    public function test_create_task_with_valid_data(): void
    {
        Event::fake();

        $dto = new CreateTaskDTO(
            'Test Task',
            'Test Description',
            '2020-10-26 00:00:00',
            'pending',
            'high',
            2,
            2
        );

        $expectedTask = new Task([
            'id' => 2,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => '2020-10-26 00:00:00',
            'status' => 'pending',
            'priority' => 'high',
            'user_id' => 2,
            'created_by' => 2,
            'created_at' => '2020-10-20 00:00:00',
            'updated_at' => '2020-10-20 00:00:00',
            'deleted_at' => null,
        ]);

        $mock = Mockery::mock(CreateTaskRepositoryInterface::class);

        $mock->shouldReceive('create')
            ->once()
            ->with($dto)
            ->andReturn($expectedTask);

        $service = new CreateTaskService($mock);

        $data = $service->execute($dto);
        $this->assertEquals($data->title, $dto->title);
        $this->assertEquals($data->description, $dto->description);
        $this->assertEquals($data->due_date, $dto->due_date);
        $this->assertEquals($data->status, $dto->status);
    }

    public function test_task_created_event_is_dispatched(): void
    {
        Event::fake();

        $dto = new CreateTaskDTO(
            'Test Task',
            'Test Description',
            '2020-10-26 00:00:00',
            'pending',
            'high',
            2,
            2
        );

        $expectedTask = new Task([
            'id' => 2,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => '2020-10-26 00:00:00',
            'status' => 'pending',
            'priority' => 'high',
            'user_id' => 2,
            'created_by' => 2,
            'created_at' => '2020-10-20 00:00:00',
            'updated_at' => '2020-10-20 00:00:00',
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
