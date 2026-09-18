<?php

namespace Tests\Feature;

use App\Models\PgNotification;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdministrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_logout_and_non_admin_login_rejection(): void
    {
        $admin = User::factory()->create(['password' => Hash::make('A-secure-test-password')]);
        $admin->forceFill(['is_admin' => true])->save();
        $this->post('/login', ['email' => $admin->email, 'password' => 'wrong'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => $admin->email, 'password' => 'A-secure-test-password'])->assertRedirect('/');
        $this->assertAuthenticatedAs($admin);
        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
        $user = User::factory()->create(['password' => Hash::make('A-secure-test-password')]);
        $this->post('/login', ['email' => $user->email, 'password' => 'A-secure-test-password'])->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_property_settings_notifications_and_document_index(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();
        $this->actingAs($admin);
        $this->post('/settings/property', ['name' => 'My Ladies PG', 'phone' => '9000000000', 'email' => 'pg@example.com'])->assertSessionHasNoErrors();
        $this->get('/settings')->assertOk()->assertSee('My Ladies PG');
        Resident::create(['full_name' => 'New Resident', 'mobile' => '9000000000', 'joining_date' => today()->toDateString(), 'status' => 'active']);
        $this->post('/notifications/refresh')->assertSessionHasNoErrors();
        $count = PgNotification::count();
        $this->assertGreaterThan(0, $count);
        $this->post('/notifications/refresh')->assertSessionHasNoErrors();
        $this->assertSame($count, PgNotification::count());
        $this->get('/notifications')->assertOk()->assertSee('New Resident');
        $this->post('/notifications/'.PgNotification::first()->id.'/read')->assertSessionHasNoErrors();
        $this->assertNotNull(PgNotification::first()->read_at);
        $this->get('/documents')->assertOk();
    }
}
