<?php

namespace Database\Factories;

use App\Models\Service;  // Your Service model namespace
use App\Models\Teacher; // Your Teacher model namespace
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define possible levels
        $levels = ['beginner', 'intermediate', 'advanced'];

        // Define realistic durations
        $durations = [30, 45, 60, 90, 120];

        return [
            // --- Foreign Key ---
            // Ensure TeacherFactory exists!
            'teacher_id' => Teacher::factory(),

            // --- Service Details ---
            'title' => fake()->catchPhrase() . ' ' . fake()->randomElement(['Tutoring', 'Workshop', 'Consultation', 'Lesson']), // More service-like title
            'description' => fake()->optional(0.8)->paragraph(rand(2, 5)), // 80% chance of having a description
            'price' => fake()->randomFloat(2, 15, 250), // Price between 15.00 and 250.00
            'duration_minutes' => fake()->randomElement($durations), // Pick a realistic duration
            'level' => fake()->randomElement($levels), // Pick a random level

            // 'created_at', 'updated_at' handled automatically
        ];
    }

    // --- Level States (Optional but useful) ---

    /**
     * Indicate that the service is for beginners.
     */
    public function beginner(): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => 'beginner',
        ]);
    }

    /**
     * Indicate that the service is for intermediate level.
     */
    public function intermediate(): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => 'intermediate',
        ]);
    }

    /**
     * Indicate that the service is for advanced level.
     */
    public function advanced(): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => 'advanced',
        ]);
    }

    // --- Other Potential States ---

    /**
     * Indicate that the service is a specific duration (e.g., 60 minutes).
     */
    public function duration(int $minutes): static
    {
         return $this->state(fn (array $attributes) => [
            'duration_minutes' => $minutes,
        ]);
    }
}