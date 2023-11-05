<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function user_update_delete_another_user(): void
    {
        $this->actingAs($this->attacker);
        $response = $this->get(route('profiles.edit', $this->user))->assertStatus(403);
        $response = $this->put(route('profiles.update', $this->user),
            ['username' => $this->faker->unique()->userName])->assertStatus(403);
        $response = $this->delete(route('profiles.update', $this->user))->assertStatus(403);
    }

    /**
     * @test
     */
    public function guest_update_delete_user(): void
    {
        $response = $this->get(route('profiles.edit', $this->user))->assertForbidden();
        $response = $this->put(route('profiles.update', $this->user),
            ['username' => $this->faker->unique()->userName])->assertForbidden();
        $response = $this->delete(route('profiles.update', $this->user))->assertForbidden();
    }

    public function user_register_new_user(): void {
        $this->actingAs($this->attacker);
        $response = $this->get(route('register'))->assertRedirect();
        $response = $this->post(route('register.form_post'), [
            'username' => $this->faker->unique()->userName,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertForbidden();
    }
}
