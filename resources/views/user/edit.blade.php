@php
    use App\Services\FileStorageService;

    $profilePicturePath = app(FileStorageService::class)->userProfilePicture($user);
@endphp
<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6">
        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">User Settings</h1>

                <p class="mt-1 text-sm text-gray-500">
                    Manage {{ $user->name }}'s account information and profile picture.
                </p>
            </div>

            {{-- Delete User --}}
            <form
                action="{{ route('portal.user.destroy', ['user' => $user, 'portal' => currentPortal()]) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to permanently delete {{ addslashes($user->name) }}? This action cannot be undone.');"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    title="Delete user"
                    aria-label="Delete {{ $user->name }}"
                    class="inline-flex h-10 w-10 cursor-pointer items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-600 transition hover:bg-red-100 hover:text-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-none"
                >
                    <x-lucide-trash-2 width="20" height="20" class="transition" />
                </button>
            </form>
        </div>

        {{-- User Information --}}
        <section class="overflow-hidden rounded-2xl bg-white shadow-xl">
            {{-- Section Header --}}
            <div class="border-b border-gray-100 px-5 py-4">
                <h2 class="text-lg font-semibold text-gray-900">User Information</h2>

                <p class="mt-1 text-sm text-gray-500">Update the user's basic account information.</p>
            </div>

            {{-- Form --}}
            <form
                action="{{ route('portal.user.update', ['portal' => currentPortal(), 'user' => $user]) }}"
                method="POST"
                class="p-5"
            >
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block font-medium text-gray-700"> Name </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            autocomplete="name"
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200 focus:outline-none"
                        />

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block font-medium text-gray-700"> Email Address </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            autocomplete="email"
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200 focus:outline-none"
                        />

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    @if (auth()->user()->hasAnyRole(['admin', 'service_provider']))
                        <div>
                            <label for="role" class="block font-medium text-gray-700"> Role </label>

                            <select
                                name="role"
                                id="role"
                                class="mt-1 w-full rounded-md border border-gray-300 bg-white p-2 focus:ring focus:ring-blue-200 focus:outline-none"
                            >
                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->name }}"
                                        @selected(old('role', $user->roles->first()?->name) === $role->name)
                                    >
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="role" value="client" />

                    @endif
                </div>

                {{-- Actions --}}
                <div class="mt-5 flex justify-end pt-5">
                    <button
                        type="submit"
                        class="inline-flex cursor-pointer items-center gap-2 rounded-xl bg-green-500 px-5 py-3 text-white transition hover:bg-green-600 hover:ring-2 hover:ring-green-500 hover:ring-offset-2 hover:outline-none"
                    >
                        <i class="fa-solid fa-check"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </section>

        {{-- Profile Picture --}}
        <section class="overflow-hidden rounded-2xl bg-white shadow-xl">
            {{-- Section Header --}}
            <div class="border-b border-gray-100 px-5 py-4">
                <h2 class="text-lg font-semibold text-gray-900">Profile Picture</h2>

                <p class="mt-1 text-sm text-gray-500">Update the profile picture for this user.</p>
            </div>

            <div class="p-5">
                {{-- Current Picture --}}
                <div class="flex items-center gap-4">
                    <img
                        src="{{ $profilePicturePath ?? asset('anonymous_picture.jpg') }}"
                        alt="Profile picture of {{ $user->name }}"
                        class="h-14 w-14 rounded-full border-2 border-gray-100 object-cover"
                    />

                    <div>
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>

                        <p class="text-sm text-gray-500">Current profile picture</p>
                    </div>
                </div>

                {{-- Upload Form --}}
                <form
                    action="{{ route('portal.user.profile', ['portal' => currentPortal(), 'user' => $user]) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-5"
                >
                    @csrf

                    <div>
                        <label for="file" class="block font-medium text-gray-700"> Choose a new picture </label>

                        <input
                            type="file"
                            id="file"
                            name="file"
                            required
                            accept="image/*"
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200 focus:outline-none"
                        />

                        <p class="mt-1 text-xs text-gray-500">Recommended: JPG, PNG or JPEG.</p>

                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="portal_id" value="{{ currentPortal()->id }}" />

                    <button
                        type="submit"
                        class="mt-4 w-full cursor-pointer rounded-xl bg-green-500 py-3 font-semibold text-white transition hover:bg-green-600 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none"
                    >
                        <i class="fa-solid fa-camera mr-1"></i>
                        Update Profile Picture
                    </button>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
