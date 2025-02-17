<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $this->seed();
        $response = $this->get(route('task.index'));
        $response->assertStatus(200);
        $response->assertViewHas('task', 'name');
    }
}
