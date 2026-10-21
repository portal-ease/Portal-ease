<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create(array $data, ?int $portalId = null): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'portal_id' => $data['portal_id'] ?? $portalId,
        ]);

        if ($data['role']) {
            $this->refreshRole($user, $data['role']);
        }

        return $user;
    }

    public function update(User $user, array $data): void
    {
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        $this->refreshRole($user, $data['role']);
    }

    private function refreshRole(User $user, string $newRole): void
    {
        foreach ($user->getRoleNames() as $role) {
            $user->removeRole($role);
        }
        $user->assignRole($newRole);
    }
}
