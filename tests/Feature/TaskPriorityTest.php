<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskPriorityTest extends TestCase
{
    public function test_task_priority_endpoint_returns_sorted_tasks(): void
    {
        Task::factory()->create([
            'importance' => 5,
            'deadline' => now()->addDay()
        ]);

        Task::factory()->create([
            'importance' => 1,
            'deadline' => now()->addDays(10)
        ]);

        $response = $this->getJson('/api/tasks/priority');

        $response->assertStatus(200)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(2, 'data');

        $this->assertTrue($response->json('data')[0]['priority_score'] > $response->json('data')[1]['priority_score']);
    }
}
