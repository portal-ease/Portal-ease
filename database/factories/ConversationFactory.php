<?php

namespace Database\Factories;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'p2p',
        ];
    }
    public function withUsers(array $userIds)
    {
        return $this->afterCreating(function (Conversation $conversation) use ($userIds) {
            $conversation->users()->sync($userIds);
        });
    }
}
