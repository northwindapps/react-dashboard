<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\Appointment;
use App\Models\Service;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Teacher::factory(10)->create();
        Student::factory(10)->create();
        Payment::factory(10)->create();
        Lesson::factory(10)->create();
        LessonStudent::factory(10)->create();
        Appointment::factory(10)->create();
        Service::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
