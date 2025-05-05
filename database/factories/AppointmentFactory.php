<?php

namespace Database\Factories;

use App\Models\Appointment; // Your Appointment model namespace
use App\Models\User;        // Your User model namespace (for student/teacher)
use App\Models\Lesson;      // Your Lesson model namespace
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon; // Useful for date manipulation

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate start time (e.g., within the next month)
        $startTime = fake()->dateTimeBetween('now', '+1 month');

        // Generate end time (e.g., 30-90 minutes after start time)
        $endTime = (clone $startTime)->modify('+'.rand(30, 90).' minutes');

        // Define possible statuses
        $statuses = ['scheduled', 'completed', 'cancelled'];

        return [
            // --- Foreign Keys ---
            // Ensure UserFactory exists!
            // Note: For a real app, you might want logic to ensure student != teacher,
            // possibly by fetching existing users or using specific states.
            'student_id' => User::factory(),
            'teacher_id' => User::factory(),

            // Optionally link to a Lesson (e.g., 60% chance)
            // Ensure LessonFactory exists!
            'lesson_id' => fake()->optional(0.6)->passthrough(
                             fn() => Lesson::factory()->create()->id // Create lesson if chosen
                         ),


            // --- Time and Status ---
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => fake()->randomElement($statuses), // Randomly pick a status

            // 'created_at', 'updated_at' handled automatically
        ];
    }

    // --- Status States (Optional but useful) ---

    /**
     * Indicate that the appointment is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'scheduled',
        ]);
    }

    /**
     * Indicate that the appointment is completed (and likely in the past).
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            // Generate past start/end times for completed appointments
            $startTime = fake()->dateTimeBetween('-1 month', '-1 day');
            $endTime = (clone $startTime)->modify('+'.rand(30, 90).' minutes');
            return [
                'status' => 'completed',
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];
        });
    }

    /**
     * Indicate that the appointment is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }

    // --- Lesson Link States (Optional) ---

     /**
     * Indicate that the appointment should be linked to a lesson.
     */
    public function withLesson(): static
    {
        return $this->state(fn (array $attributes) => [
             // Ensure LessonFactory exists
            'lesson_id' => Lesson::factory(),
        ]);
    }

     /**
     * Indicate that the appointment should not be linked to a lesson.
     */
    public function withoutLesson(): static
    {
         return $this->state(fn (array $attributes) => [
            'lesson_id' => null,
        ]);
    }
}