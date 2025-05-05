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
        User::factory(20000)->create();
        Teacher::factory(20000)->create();
        Student::factory(20000)->create();
        Payment::factory(20000)->create();
        Lesson::factory(20000)->create();
        LessonStudent::factory(20000)->create();
        Appointment::factory(20000)->create();
        Service::factory(20000)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
