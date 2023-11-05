<?php

namespace Tests;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();

        $this->user = User::factory()->create([
            'username' => $this->faker->unique()->userName,
        ]);
        $this->attacker = User::factory()->create([
            'username' => $this->faker->unique()->userName,
        ]);
    }

    protected function tearDown(): void
    {
        $this->user->delete();
        $this->attacker->delete();
        parent::tearDown();
    }
}
