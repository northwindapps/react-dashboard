<?php

namespace Database\Factories;

use App\Models\Student; // Ensure this matches your Student model's namespace
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Generates a random person's name
            'email' => fake()->unique()->safeEmail(), // Generates a unique, safe email address
            // 'created_at' and 'updated_at' are automatically handled.
        ];
    }
}