<?php

use App\Models\Conversation;
use App\Models\File;
use App\Models\Invoice;
use App\Models\Portal;
use App\Models\Project;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

function createUserModelTestPortal(array $attributes = []): Portal
{
    return Portal::withoutEvents(fn () => Portal::create(array_merge([
        'name' => fake()->unique()->slug(),
        'email' => fake()->unique()->safeEmail(),
        'branding_color' => '#2563eb',
    ], $attributes)));
}

it('uses the expected mass assignable attributes', function () {
    $user = new User;

    expect($user->getFillable())->toBe([
        'name',
        'email',
        'password',
        'portal_id',
        'email_verified_at',
    ]);
});

it('hashes passwords and casts email verification timestamps', function () {
    $user = User::factory()->create([
        'portal_id' => createUserModelTestPortal()->id,
        'password' => 'secret-password',
        'email_verified_at' => '2026-09-18 12:00:00',
    ]);

    expect($user->password)
        ->not->toBe('secret-password')
        ->and(Hash::check('secret-password', $user->password))->toBeTrue()
        ->and($user->email_verified_at)->toBeInstanceOf(DateTimeInterface::class);
});

it('hides sensitive attributes when serialized', function () {
    $user = User::factory()->create([
        'portal_id' => createUserModelTestPortal()->id,
        'password' => 'secret-password',
        'remember_token' => 'token-value',
    ]);

    expect($user->toArray())
        ->not->toHaveKeys(['password', 'remember_token']);
});

it('belongs to a portal', function () {
    $portal = createUserModelTestPortal();
    $user = User::factory()->create(['portal_id' => $portal->id]);

    expect($user->portal)
        ->toBeInstanceOf(Portal::class)
        ->id->toBe($portal->id);
});

it('has many invoices', function () {
    $portal = createUserModelTestPortal();
    $user = User::factory()->create(['portal_id' => $portal->id]);
    $file = File::factory()->create();
    $project = Project::factory()->create([
        'portal_id' => $portal->id,
        'user_id' => $user->id,
    ]);
    $invoice = Invoice::factory()->create([
        'portal_id' => $portal->id,
        'user_id' => $user->id,
        'file_id' => $file->id,
        'project_id' => $project->id,
    ]);

    expect($user->invoices)
        ->toHaveCount(1)
        ->first()->id->toBe($invoice->id);
});

it('belongs to many files', function () {
    $user = User::factory()->create(['portal_id' => createUserModelTestPortal()->id]);
    $files = File::factory()->count(2)->create();

    $user->files()->attach($files->pluck('id'));

    expect($user->files)
        ->toHaveCount(2)
        ->pluck('id')->all()->toEqualCanonicalizing($files->pluck('id')->all());
});

it('belongs to many conversations', function () {
    $user = User::factory()->create(['portal_id' => createUserModelTestPortal()->id]);
    $conversations = Conversation::factory()->count(2)->create();

    $user->conversations()->attach($conversations->pluck('id'));

    expect($user->conversations)
        ->toHaveCount(2)
        ->pluck('id')->all()->toEqualCanonicalizing($conversations->pluck('id')->all());
});

it('requires email verification', function () {
    expect(new User)->toBeInstanceOf(MustVerifyEmail::class);
});

it('sends the portal-aware reset password notification', function () {
    Notification::fake();

    $portal = createUserModelTestPortal();
    $user = User::factory()->create(['portal_id' => $portal->id]);

    $user->sendPasswordResetNotification('reset-token');

    Notification::assertSentTo(
        $user,
        ResetPasswordNotification::class,
        fn (ResetPasswordNotification $notification) => $notification->token === 'reset-token'
            && $notification->portal->is($portal)
    );
});
