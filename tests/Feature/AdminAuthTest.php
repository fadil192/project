<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect('/admin/login');
    }

    public function test_guest_cannot_access_any_admin_page(): void
    {
        foreach (['/admin/hero', '/admin/products', '/admin/settings'] as $url) {
            $this->get($url)->assertRedirect('/admin/login');
        }
    }

    public function test_admin_login_page_can_be_opened(): void
    {
        $this->get('/admin/login')->assertOk()->assertSee('Admin Panel');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'Admin12345!',
            'is_admin' => true,
        ]);

        $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'Admin12345!',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_can_access_dashboard_after_login(): void
    {
        User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);

        $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $this->get('/admin/dashboard')->assertOk()->assertSee('Dashboard');
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);

        $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_non_admin_cannot_login_to_admin_panel(): void
    {
        User::factory()->create([
            'email' => 'staff@example.com',
            'password' => 'password',
            'is_admin' => false,
        ]);

        $this->post('/admin/login', [
            'email' => 'staff@example.com',
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_logout_works(): void
    {
        $admin = User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);

        $this->actingAs($admin);

        $this->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}