<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Application;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_application()
    {
        $data = [
            'applicant_name' => 'Minh Huynh',
            'programme' => 'IT',
            'intake' => '2025',
        ];

        $response = $this->postJson('/api/applications', $data);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'applicant_name' => 'Minh Huynh',
                'programme' => 'IT',
                'intake' => '2025',
            ]);

        $this->assertDatabaseHas('applications', [
            'applicant_name' => 'Minh Huynh'
        ]);
    }

    public function test_it_can_update_application()
    {
        $app = Application::factory()->create([
            'status' => 'submitted',
            'payment_status' => 'unpaid',
        ]);

        $updateData = [
            'status' => 'accepted',
            'payment_status' => 'paid',
        ];

        $response = $this->putJson("/api/applications/{$app->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'status' => 'accepted',
                'payment_status' => 'paid',
            ]);

        $this->assertDatabaseHas('applications', [
            'id' => $app->id,
            'status' => 'accepted',
            'payment_status' => 'paid',
        ]);
    }
}
