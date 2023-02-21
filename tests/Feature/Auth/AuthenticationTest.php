<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = $this->createTestUser();

        $response = $this->post('/login', [
            'rfc' => $user->rfc,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = $this->createTestUser();

        $this->post('/login', [
            'rfc' => $user->rfc,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    private function createTestUser()
    {
        return User::factory()->create([]);
    }
}
