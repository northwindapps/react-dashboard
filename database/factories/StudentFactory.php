<?php

namespace Database\Factories;
use App\Models\User;
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
        $randomUserId = rand(1, 20000);

        // 2. Attempt to find the User with that specific ID
        // User::find($id) is the Eloquent shortcut for User::where('id', $id)->first()
        $user = User::find($randomUserId);

        return [
            'user_id' => $user->id,
            'name' => $user->name, // Generates a random person's name
            'email' => $user->email, // Generates a unique, safe email address
            // 'created_at' and 'updated_at' are automatically handled.
        ];
    }
}