<?php

namespace Database\Factories;

use App\Models\Lesson;       // <-- Adjust if your Lesson model is elsewhere
use App\Models\Student;      // <-- Adjust if your Student model is elsewhere
use App\Models\LessonStudent; // <-- Adjust if your Pivot model is elsewhere or doesn't exist
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonStudent>
 */
class LessonStudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * Note: Pivot tables like 'lesson_student' often don't have a dedicated Eloquent model
     * unless you explicitly define one (e.g., using ->using(LessonStudent::class) on the
     * belongsToMany relationship definition in your Lesson or Student model).
     * If you DON'T have an App\Models\LessonStudent model, you can remove or comment out
     * this $model property, but the factory might be used differently (e.g., indirectly).
     *
     * @var string
     */
    protected $model = LessonStudent::class; // Or your specific pivot model class if it exists

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Use the factories for Lesson and Student to ensure valid foreign keys exist.
            // This approach creates a new Lesson and a new Student record each time
            // this factory definition runs, guaranteeing referential integrity and
            // avoiding the unique constraint issue for these specific new records.
            'lesson_id' => Lesson::factory(),
            'student_id' => Student::factory(),

            // Timestamps (created_at, updated_at) are usually handled automatically
            // by Eloquent when records are created, so you often don't need
            // to define them here unless you need specific dates.
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ];
    }
}