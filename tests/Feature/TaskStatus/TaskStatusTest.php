<?php

namespace Tests\Feature\TaskStatus;

use App\Models\TaskStatus as ModelsTaskStatus;
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
        $response = $this->get('/task_statuses');
        $response->assertStatus(200);
        $this->assertCount(5, $response->json());
    }

    public function testShow(): void
    {
        $testTask = ModelsTaskStatus::factory()->create(['name' => 'test']);
        $response = $this->get("/task_statuses/{$testTask->id}");
        $response->assertStatus(200);
        $response->assertSee('test');
    }

    public function testStore(): void
    {
        $status = [
            'name' => 'test'
        ];
        $response = $this->post($status);
        
        $response->assertStatus(200);
        $response->assertRedirect('/task_statuses');
        $response->assertDatabaseHas('task_statuses', ['name' => 'test']);
    }

    public function testPatch(): void
    {
        $testTask = ModelsTaskStatus::factory()->create();
        $newTaskData = [
            'name' => 'test2'
        ];
        $response = $this->patch("/task_statuses/{$testTask->id}", $newTaskData);
        
        $response->assertStatus(200);
        $response->assertRedirect('/task_statuses');
        $response->assertDatabaseHas('task_statuses', ['name' => 'test2']);
    }

    public function testDelete(): void
    {
        $testTask = ModelsTaskStatus::factory()->create();
        $response = $this->delete("/task_statuses/{$testTask->id}");
        
        $response->assertStatus(200);
        $response->assertRedirect('/task_statuses');
        $response->assertDeleted($testTask);
    }
}
