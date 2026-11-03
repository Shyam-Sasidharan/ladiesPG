<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('SJ Ladies Hostel');
        $response->assertSee('A1');
        $response->assertSee('B1');
        $response->assertSee('₹6,500');
        $response->assertSee('₹4,200');
        $response->assertSee('₹8,600');
    }

    public function test_visitor_can_submit_booking_enquiry(): void
    {
        $response = $this->post('/enquiry', [
            'name' => 'Meera Patel',
            'phone' => '9876543210',
            'email' => 'meera@example.com',
            'room_number' => 'A1',
            'sharing_type' => 'Five Sharing',
            'food_preference' => 'with_food',
            'joining_date' => today()->toDateString(),
            'notes' => 'Please confirm ground floor bed',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('notifications', [
            'type' => 'booking_enquiry',
        ]);
    }
}
