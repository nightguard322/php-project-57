<?php

namespace Tests\Feature\TaskStatus;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatus extends TestCase
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

    public function testCreate(): void
    {
        $status = TaskStatus::factory()
        $this->post($status);
        $response = $this->get('/task_statuses');
        
        $response->assertStatus(200);
        $response->assertSee('test');
        $response->assertSee('test2');
    }
}
