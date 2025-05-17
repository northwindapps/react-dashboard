<?php

namespace Database\Factories;

use App\Models\Lesson;   // Adjust if your Lesson model namespace is different
use App\Models\Teacher;  // Adjust if your Teacher model namespace is different
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon; // Useful for date manipulation

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a start time, e.g., sometime in the next week
        $startTime = fake()->dateTimeBetween('now', '+1 week');

        // Determine if there's an end time (e.g., 80% chance)
        // and make sure it's after the start time (e.g., 1-3 hours later)
        $endTime = fake()->optional(0.8) // 80% chance end_time is not null
                       ->dateTimeBetween(
                           $startTime,
                           // Clone start time to avoid modifying it, then add hours
                           (clone $startTime)->modify('+'.rand(1, 3).' hours')
                       );
        $randomUserId = rand(1, 20000);

        $teacher = Teacher::find($randomUserId);

        return [
            'title' => fake()->sentence(3), // Generate a short sentence for the title
            'description' => fake()->optional()->paragraph(2), // Optionally generate a 2-sentence paragraph
            'start_time' => $startTime,
            'end_time' => $endTime,

            // Associate with a Teacher. Assumes you have a Teacher model and TeacherFactory.
            // This will create a new Teacher if one isn't provided.
            'teacher_id' => $teacher->id,

            // 'created_at' and 'updated_at' handled automatically
        ];
    }

    /**
     * Indicate that the lesson has a defined end time (helper state).
     */
    public function scheduled(): static
    {
        return $this->state(function (array $attributes) {
            // Ensure start_time is generated first if not present
            $startTime = $attributes['start_time'] ?? fake()->dateTimeBetween('now', '+1 week');

            return [
                'start_time' => $startTime, // Ensure start_time is set
                'end_time' => fake()->dateTimeBetween(
                    $startTime,
                    (clone $startTime)->modify('+'.rand(1, 3).' hours')
                ),
            ];
        });
    }

    /**
     * Indicate that the lesson does not have a defined end time (helper state).
     */
    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'end_time' => null,
        ]);
    }
}