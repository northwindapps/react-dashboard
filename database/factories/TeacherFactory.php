<?php

namespace Database\Factories;
use App\Models\User; // 
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
        $randomUserId = rand(1, 20000);

        // 2. Attempt to find the User with that specific ID
        // User::find($id) is the Eloquent shortcut for User::where('id', $id)->first()
        $user = User::find($randomUserId);

        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
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