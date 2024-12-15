<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_success()
    {
        // Arrange
        $user = UserAccount::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Act
        $response = $this->post('/loginin', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Assert
        $response->assertRedirect(route('emission.index'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_fail_invalid_credentials()
    {
        // Arrange
        $user = UserAccount::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Act
        $response = $this->post('/loginin', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert
        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'Invalid credentials. Please try again.');
        $this->assertGuest();
    }

    /** @test */
    public function login_fail_no_account()
    {
        // Act
        $response = $this->post('/loginin', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        // Assert
        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'No account found with this email.');
        $this->assertGuest();
    }

    /** @test */
    public function register_success()
    {
        // Act
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert
        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Account created successfully! Please log in.');
        $this->assertDatabaseHas('useraccount', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function register_fail_email_taken()
    {
        // Arrange
        UserAccount::factory()->create([
            'email' => 'test@example.com',
        ]);

        // Act
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert
        $response->assertRedirect('/register');
        $response->assertSessionHas('error', 'The email has already been taken.');
        $this->assertCount(1, UserAccount::where('email', 'test@example.com')->get());
    }

    /** @test */
    public function update_profile_success()
    {
        // Arrange
        $user = UserAccount::factory()->create([
            'password' => Hash::make('oldpassword'),
        ]);

        $this->actingAs($user);

        // Act
        $response = $this->post('/profile/update', [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
            'old_password' => 'oldpassword',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        // Assert
        $response->assertRedirect('/profile');
        $response->assertSessionHas('success', 'Profile updated successfully!');
        $this->assertDatabaseHas('useraccount', [
            'email' => 'updated@example.com',
        ]);
        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }

    /** @test */
    public function update_profile_fail_wrong_old_password()
    {
        // Arrange
        $user = UserAccount::factory()->create([
            'password' => Hash::make('oldpassword'),
        ]);

        $this->actingAs($user);

        // Act
        $response = $this->post('/profile/update', [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
            'old_password' => 'wrongpassword',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        // Assert
        $response->assertRedirect('/profile');
        $response->assertSessionHasErrors(['old_password' => 'The old password is incorrect.']);
        $this->assertTrue(Hash::check('oldpassword', $user->fresh()->password));
    }

    /** @test */
    public function logout_success()
    {
        // Arrange
        $user = UserAccount::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->post('/logout');

        // Assert
        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Logged out successfully!');
        $this->assertGuest();
    }
}
