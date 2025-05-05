<?php

namespace Database\Factories;

use App\Models\Payment; // Make sure this matches your Payment model's namespace
use App\Models\User;    // Make sure this matches your User model's namespace
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomUserId = rand(1, 20000);

        $user = User::find($randomUserId);
        // Define possible statuses based on your application logic
        $statuses = ['pending', 'completed', 'failed', 'refunded', 'cancelled'];

        return [
            // Associate with a User. This will automatically create a User
            // using its factory if one doesn't exist or isn't provided.
            'user_id' => $user->id,

            // Generate a random decimal amount with 2 decimal places.
            // Adjust the min/max range (10.00 to 1000.00 here) as needed.
            'amount' => fake()->randomFloat(2, 10, 1000),

            // Pick a random status from the predefined list.
            // Note: The migration default is 'pending', but the factory
            // can generate various statuses for testing/seeding diversity.
            'status' => fake()->randomElement($statuses),

            // 'created_at' and 'updated_at' are handled automatically.
        ];
    }

    /**
     * Indicate that the payment is pending.
     * (Example of a state)
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

     /**
     * Indicate that the payment is completed.
     * (Example of a state)
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the payment has failed.
     * (Example of a state)
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
}