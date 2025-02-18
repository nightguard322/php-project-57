<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $this->seed();
        $response = $this->get(route('task.index'));
        $response->assertStatus(200);
        $response->assertViewHas('task', 'name');

        $testTask = [
            'name' => 'Тестовая задача',
            'description' => 'Тестовая задача',
            'status_id' => 1, 
            'created_by_id' => 2,
            'assigned_to_id' => 3
        ];
        $testTaskId = Task::create($testTask)->id();
        $response = $this->get(route('task.show'), $testTaskId);
        $response->assertStatus(200);
        $this->assertDatabaseHas('task', $testTask);
        $response->assertSee('Тестовая задача');
    }

    public function testSave()
    {
        $testTask = [
            'name' => 'Тестовая задача 2',
            'description' => 'Тестовая задача 2',
            'status_id' => 1, 
            'created_by_id' => 2,
            'assigned_to_id' => 3
        ];

        $response = $this->post(route('task.store'), $testTask);
        $response->assertStatus(302);
        $response->assertRedirect(route('task.index'));
        $this->assertDatabaseHas('task', $testTask);
        $response->assertSee('Тестовая задача 2');
    }

    public function testUpdate()
    {
        $this->seed();
        $testTask = Task::first();
        $testData = ['name' => 'Исправленное имя'];

        $response = $this->patch(route('task.update', $testTask), $testData);
        $response->assertStatus(302);
        $response->assertRedirect(route('task.show', $testTask));
        $this->assertDatabaseHas('task', $testTask);
        $response->assertSee('Исправленное имя');
    }

    public function testDelete()
    {
        $this->seed();
        $testTask = Task::first();

        $response = $this->delete(route('task.destroy', $testTask));
        $response->assertStatus(302);
        $response->assertRedirect(route('task.index'));
        $this->assertDatabaseHas('task', $testTask);
        $this->assertDatabaseMissing('tasks', ['name' => $testTask->name]);
    }

}
