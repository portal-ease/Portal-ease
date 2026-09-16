<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (app()->environment() === 'production') {
            Role::create(['name' => 'manager', 'guard_name' => 'web']);
            Role::create(['name' => 'employee', 'guard_name' => 'web']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (app()->environment() === 'production') {
            Role::destroy(['name' => 'manager', 'guard_name' => 'web']);
            Role::destroy(['name' => 'employee', 'guard_name' => 'web']);
        }
    }
};
