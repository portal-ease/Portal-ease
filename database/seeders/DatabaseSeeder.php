<?php

namespace Database\Seeders;

use App\Models\Portal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $portal = Portal::create([
            'name' => config('seeders.portal.name'),
            'email' => config('seeders.portal.email'),
            'branding_color' => config('seeders.portal.branding_color'),
        ]);
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@portalease.com',
            'portal_id' => $portal->id,
        ]);
        $admin->assignRole('service_provider');
        $admin->assignRole('admin');


        $client = User::factory()->create([
            'name' => 'client',
            'email' => 'client@portalease.com',
            'portal_id' => $portal->id,
        ]);
        $client->assignRole('client');
    }
}
