<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Invoice;
use App\Models\Portal;
use App\Models\Project;
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

        $projects = Project::factory(10)->create([
            'user_id' => $client->id,
            'portal_id' => $portal->id,
        ]);

        $files = File::factory(10)->create();

        Invoice::factory(10)->create([
            'file_id' => $files->random()->id,
            'portal_id' => $portal->id,
            'project_id' => $projects->random()->id,
            'user_id' => $client->id,
        ]);
    }
}
