<?php

use App\Context\CurrentPortal;
use App\Http\Middleware\ResolveCurrentPortal;
use App\Models\Conversation;
use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

function createUserControllerPortal(): Portal
{
    return Portal::withoutEvents(fn () => Portal::create([
        'name' => fake()->unique()->slug(),
        'email' => fake()->unique()->safeEmail(),
        'branding_color' => '#2563eb',
    ]));
}

function createUserControllerUser(Portal $portal, string $role = 'service_provider'): User
{
    Role::findOrCreate($role, 'web');

    $user = User::factory()->create(['portal_id' => $portal->id]);
    $user->assignRole($role);

    return $user;
}

beforeEach(function () {
    $this->withoutMiddleware(ResolveCurrentPortal::class);
});

function actingAsPortalUser(Portal $portal, string $role = 'service_provider'): User
{
    app(CurrentPortal::class)->set($portal);

    $user = createUserControllerUser($portal, $role);
    test()->actingAs($user);

    return $user;
}

it('displays the user index and create forms', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);

    $this->get(route('portal.user.index', $portal))
        ->assertOk()
        ->assertViewIs('user.index')
        ->assertViewHas('portal', fn (Portal $viewPortal) => $viewPortal->is($portal));

    $this->get(route('portal.user.create', $portal))
        ->assertOk()
        ->assertViewIs('user.create')
        ->assertViewHas('portal', fn (Portal $viewPortal) => $viewPortal->is($portal));
});

it('creates a user in the supplied portal with the requested role', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);
    Role::findOrCreate('client', 'web');

    $response = $this->post(route('portal.user.store', $portal), [
        'name' => 'New Client',
        'email' => 'new-client@example.test',
        'password' => 'secure-password',
        'portal_id' => $portal->id,
        'role' => 'client',
    ]);

    $response->assertRedirectToRoute('portal.user.index', $portal);

    $user = User::query()->where('email', 'new-client@example.test')->firstOrFail();

    expect($user->name)->toBe('New Client')
        ->and($user->portal_id)->toBe($portal->id)
        ->and(Hash::check('secure-password', $user->password))->toBeTrue()
        ->and($user->hasRole('client'))->toBeTrue();
});

it('validates user creation input', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);

    $this->from(route('portal.user.create', $portal))
        ->post(route('portal.user.store', $portal), [])
        ->assertRedirect(route('portal.user.create', $portal))
        ->assertSessionHasErrors(['name', 'email', 'password', 'portal_id', 'role']);
});

it('displays a user and their first conversation', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);
    $user = createUserControllerUser($portal, 'client');
    $conversation = Conversation::query()->firstOrFail();

    $this->get(route('portal.user.show', [$portal, $user]))
        ->assertOk()
        ->assertViewIs('user.show')
        ->assertViewHas('portal', fn (Portal $viewPortal) => $viewPortal->is($portal))
        ->assertViewHas('user', fn (User $viewUser) => $viewUser->is($user))
        ->assertViewHas('conversationP2p', fn (Conversation $viewConversation) => $viewConversation->is($conversation));
});

it('displays the edit form with profile image and available roles', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);
    $user = createUserControllerUser($portal, 'client');
    $file = File::factory()->create(['filename' => $user->name.$user->id.'.jpg']);
    Role::findOrCreate('admin', 'web');

    $this->get(route('portal.user.edit', [$portal, $user]))
        ->assertOk()
        ->assertViewIs('user.edit')
        ->assertViewHas('user', fn (User $viewUser) => $viewUser->is($user))
        ->assertViewHas('file', fn (File $viewFile) => $viewFile->is($file))
        ->assertViewHas('roles', fn ($roles) => $roles->pluck('name')->contains('admin'));
});

it('updates user details, clears email verification, and replaces roles', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);
    $user = createUserControllerUser($portal, 'client');
    Role::findOrCreate('manager', 'web');

    $this->from(route('portal.user.edit', [$portal, $user]))
        ->put(route('portal.user.update', [$portal, $user]), [
            'name' => 'Updated User',
            'email' => 'updated@example.test',
            'role' => 'manager',
        ])
        ->assertRedirect(route('portal.user.edit', [$portal, $user]));

    $user->refresh();

    expect($user->name)->toBe('Updated User')
        ->and($user->email)->toBe('updated@example.test')
        ->and($user->email_verified_at)->toBeNull()
        ->and($user->getRoleNames()->all())->toBe(['manager']);
});

it('deletes a user', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);
    $user = createUserControllerUser($portal, 'client');

    $this->delete(route('portal.user.destroy', [$portal, $user]))
        ->assertRedirect('/');

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

it('displays notifications for a portal', function () {
    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);

    $this->get(route('portal.notification.index', $portal))
        ->assertOk()
        ->assertViewIs('notification.index')
        ->assertViewHas('portal', fn (Portal $viewPortal) => $viewPortal->is($portal));
});

it('stores an uploaded profile picture', function () {
    Storage::fake();

    $portal = createUserControllerPortal();
    actingAsPortalUser($portal);
    $user = createUserControllerUser($portal, 'client');
    $upload = UploadedFile::fake()->image('avatar.jpg');

    $this->from(route('portal.user.edit', [$portal, $user]))
        ->post(route('portal.user.profile', [$portal, $user]), ['file' => $upload])
        ->assertRedirect(route('portal.user.edit', [$portal, $user]));

    $filename = $user->name.$user->id.'.jpg';

    Storage::assertExists("profile-pictures/{$filename}");
    $this->assertDatabaseHas('files', [
        'filename' => $filename,
        'path' => "profile-pictures/{$filename}",
        'visibility' => true,
    ]);
});
