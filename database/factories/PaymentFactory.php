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
        // It's generally safer to use User::factory() or ensure users exist
        // For this example, we'll assume User IDs 1-20000 exist or use factory.
        // $user = User::inRandomOrder()->first() ?? User::factory()->create();
        // Or, if you strictly need from a range and they exist:
        // $randomUserId = $this->faker->numberBetween(1, 20000);
        // $user = User::find($randomUserId); // This can return null

        $randomUserId = rand(1, 20000);

        $user = User::find($randomUserId);
        
        // Define possible statuses based on your application logic
        $statuses = ['pending', 'completed', 'failed', 'cancelled'];
        $status = $this->faker->randomElement($statuses);

        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now'); // Fake a created_at for realism
        $paidAt = null;

        if ($status === 'completed') {
            // If the payment is completed, set a paid_at date.
            // It should be after or equal to created_at.
            // Let's make it sometime between created_at and now, or slightly after created_at.
            $paidAt = $this->faker->dateTimeBetween($createdAt, 'now');
        }


        return [
            'user_id' => $user->id, // Eloquent factories can often take a factory instance or an ID

            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $status,
            'paid_at' => $paidAt, // <-- YOUR NEW FIELD

            // Manually set created_at and updated_at if you want them to be varied
            // and not just 'now' when the factory runs.
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
        ];
    }

    /**
     * Indicate that the payment is completed.
     */
    public function completed(): Factory
    {
        return $this->state(function (array $attributes) {
            // If created_at is already set in attributes (e.g. by definition()), use it.
            // Otherwise, generate a created_at.
            $createdAt = $attributes['created_at'] ?? $this->faker->dateTimeBetween('-1 year', 'now');

            return [
                'status' => 'completed',
                'paid_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
                'created_at' => $createdAt, // Ensure created_at is consistent
                'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'), // Ensure updated_at is consistent
            ];
        });
    }

    /**
     * Indicate that the payment is pending.
     */
    public function pending(): Factory
    {
        return $this->state(function (array $attributes) {
            $createdAt = $attributes['created_at'] ?? $this->faker->dateTimeBetween('-1 year', 'now');
            return [
                'status' => 'pending',
                'paid_at' => null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt, // For pending, updated_at might be same as created_at
            ];
        });
    }

    /**
     * Indicate that the payment has failed.
     */
    public function failed(): static // or Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'failed',
                'paid_at' => null, // Failed payments don't have a paid_at date
                'updated_at' => $this->faker->dateTimeBetween(
                    $attributes['created_at'] ?? Carbon::now()->subDays(rand(1,30)),
                    'now'
                ),
            ];
        });
    }
}