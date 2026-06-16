<?php

namespace App\Observers;

use App\Models\Conversation;
use App\Models\User;
use Database\Factories\ConversationFactory;

class NewUserInPortal
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $users = $user->portal->users;

        foreach ($users as $userI) {
            if ($userI->id === $user->id) continue;

            $existing = Conversation::whereHas('users', fn($q) =>
            $q->where('user_id', $userI->id)
            )->whereHas('users', fn($q) =>
            $q->where('user_id', $user->id)
            )->first();

            if (! $existing) {
                Conversation::factory()
                    ->withUsers([$userI->id, $user->id])
                    ->create();
            }
        }
    }

}
