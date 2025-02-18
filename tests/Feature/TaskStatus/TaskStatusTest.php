<?php

namespace Tests\Feature\TaskStatus;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     * 
     * @return void
     */
    public function testIndex(): void
    {
        $this->seed();
        $response = $this->get(route('task-statuses.index'));
        $response->assertStatus(200);
        $response->assertViewHas('statuses');
    }

    public function testStore(): void
    {
        $status = [
            'name' => 'test'
        ];
        $response = $this->post(route('task-statuses.store'), $status);
        
        $response->assertStatus(302);
        $response->assertRedirect(route('task-statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'test']);
    }

    public function testPatch(): void
    {
        $this->seed();
        $testTask = TaskStatus::first();
        $newTaskData = [
            'name' => 'test2'
        ];
        $response = $this->patch(
            route('task-statuses.update', $testTask),
            $newTaskData
        );
        
        $response->assertStatus(302);
        $response->assertRedirect(route('task-statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'test2']);
    }

    public function testDelete(): void
    {
        $this->seed();
        $testStatus = TaskStatus::first();
        $response = $this->delete(route('task-statuses.destroy', $testStatus));
        $response->assertStatus(500);

        $testStatus->tasks()->delete();
        $response = $this->delete(route('task-statuses.destroy', $testStatus));
        $response->assertRedirect('/task-statuses');
        $this->assertDatabaseMissing(
            'task_statuses', ['name' => $testStatus->name,]
        );
    }
}
