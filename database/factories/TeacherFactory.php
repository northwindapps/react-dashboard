<?php

namespace Database\Factories;

use App\Models\Teacher; // Make sure this matches your model's namespace
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class; // Connects factory to the Teacher model

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
            'specialty' => fake()->randomElement([ // Picks a random specialty or makes it null
                'Mathematics',
                'Physics',
                'History',
                'English Literature',
                'Computer Science',
                'Chemistry',
                null, // Allows for the possibility of a null specialty as per your schema
            ]),
            // 'created_at' and 'updated_at' are handled automatically by Eloquent
        ];
    }
}