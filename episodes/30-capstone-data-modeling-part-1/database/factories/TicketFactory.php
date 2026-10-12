<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'category_id' => Category::factory(),
            'customer_id' => User::factory(),
        ];
    }

    public function assignedTo(User $agent): static
    {
        return $this->state(fn (array $attributes) => [
            'assignee_id' => $agent->id,
        ]);
    }
}
