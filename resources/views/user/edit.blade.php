@php
    use App\Services\FileStorageService;

    $profilePicturePath = app(FileStorageService::class)->userProfilePicture($user);
@endphp
<x-app-layout :portal="currentPortal()">

    <div class="max-w-5xl mx-auto p-4 sm:p-6 space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    User Settings
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Manage {{ $user->name }}'s account information and profile picture.
                </p>
            </div>

            {{-- Delete User --}}
            <form action="{{ route('portal.user.destroy', ['user' => $user, 'portal' => currentPortal()]) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to permanently delete {{ addslashes($user->name) }}? This action cannot be undone.');">
                @csrf
                @method('DELETE')

                <button type="submit" title="Delete user" aria-label="Delete {{ $user->name }}"
                    class="inline-flex items-center justify-center
                           w-10 h-10
                           rounded-lg
                           bg-red-50 text-red-600
                           border border-red-100
                           hover:bg-red-100 hover:text-red-700
                           transition
                           cursor-pointer
                           focus:outline-none
                           focus:ring-2
                           focus:ring-red-500
                           focus:ring-offset-2">
                    <x-lucide-trash-2 width="20" height="20" class="transition" />
                </button>
            </form>

        </div>

        {{-- User Information --}}
        <section class="bg-white shadow-xl rounded-2xl overflow-hidden">

            {{-- Section Header --}}
            <div class="px-5 py-4 border-b border-gray-100">

                <h2 class="text-lg font-semibold text-gray-900">
                    User Information
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the user's basic account information.
                </p>

            </div>

            {{-- Form --}}
            <form action="{{ route('portal.user.update', ['portal' => currentPortal(), 'user' => $user]) }}" method="POST"
                class="p-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Name --}}
                    <div>

                        <label for="name" class="block font-medium text-gray-700">
                            Name
                        </label>

                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            required autocomplete="name"
                            class="w-full border border-gray-300 rounded-md p-2 mt-1
                                   focus:ring focus:ring-blue-200 focus:outline-none">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Email --}}
                    <div>

                        <label for="email" class="block font-medium text-gray-700">
                            Email Address
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            required autocomplete="email"
                            class="w-full border border-gray-300 rounded-md p-2 mt-1
                                   focus:ring focus:ring-blue-200 focus:outline-none">

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Role --}}
                    @if (auth()->user()->hasAnyRole(['admin', 'service_provider']))

                        <div>

                            <label for="role" class="block font-medium text-gray-700">
                                Role
                            </label>

                            <select name="role" id="role"
                                class="w-full border border-gray-300 rounded-md p-2 mt-1
                                       bg-white
                                       focus:ring focus:ring-blue-200
                                       focus:outline-none">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>
                    @else
                        <input type="hidden" name="role" value="client">

                    @endif

                </div>

                {{-- Actions --}}
                <div class="mt-5 flex justify-end pt-5">

                    <button type="submit"
                        class="inline-flex items-center gap-2
                               bg-green-500 hover:bg-green-600
                               text-white
                               rounded-xl
                               px-5 py-3
                               transition
                               cursor-pointer
                               hover:outline-none
                               hover:ring-2
                               hover:ring-green-500
                               hover:ring-offset-2">
                        <i class="fa-solid fa-check"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </section>

        {{-- Profile Picture --}}
        <section class="bg-white shadow-xl rounded-2xl overflow-hidden">

            {{-- Section Header --}}
            <div class="px-5 py-4 border-b border-gray-100">

                <h2 class="text-lg font-semibold text-gray-900">
                    Profile Picture
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the profile picture for this user.
                </p>

            </div>

            <div class="p-5">

                {{-- Current Picture --}}
                <div class="flex items-center gap-4">

                    <img src="{{ $profilePicturePath ?? asset('anonymous_picture.jpg') }}"
                        alt="Profile picture of {{ $user->name }}"
                        class="w-14 h-14 rounded-full object-cover border-2 border-gray-100">

                    <div>

                        <p class="font-medium text-gray-900">
                            {{ $user->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Current profile picture
                        </p>

                    </div>

                </div>

                {{-- Upload Form --}}
                <form action="{{ route('portal.user.profile', ['portal' => currentPortal(), 'user' => $user]) }}"
                    method="POST" enctype="multipart/form-data" class="mt-5">
                    @csrf

                    <div>

                        <label for="file" class="block font-medium text-gray-700">
                            Choose a new picture
                        </label>

                        <input type="file" id="file" name="file" required accept="image/*"
                            class="w-full border border-gray-300 rounded-md p-2 mt-1
                                   focus:ring focus:ring-blue-200
                                   focus:outline-none">

                        <p class="mt-1 text-xs text-gray-500">
                            Recommended: JPG, PNG or JPEG.
                        </p>

                        @error('file')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <input type="hidden" name="portal_id" value="{{ currentPortal()->id }}">

                    <button type="submit"
                        class="w-full mt-4
                               bg-green-500 hover:bg-green-600
                               text-white font-semibold
                               py-3
                               rounded-xl
                               transition
                               cursor-pointer
                               focus:outline-none
                               focus:ring-2
                               focus:ring-green-500
                               focus:ring-offset-2">
                        <i class="fa-solid fa-camera mr-1"></i>
                        Update Profile Picture
                    </button>

                </form>

            </div>

        </section>

    </div>

</x-app-layout>
