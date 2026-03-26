<?php

namespace Database\Factories;

use App\Models\Trainer;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'role_id' => Role::inRandomOrder()->first()?->id,
        ];
    }
}
