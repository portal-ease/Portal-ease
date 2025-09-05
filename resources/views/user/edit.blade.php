<x-app-layout :portal="$portal">
    <div class="max-w-4xl mx-auto grid grid-cols-1 items-center gap-6 p-4">

        {{-- Update User Form --}}
        <form action="{{ route('portal.user.update', ['portal' => $portal , 'user' => $user]) }}"
              method="POST"
              class="bg-white shadow-xl rounded-2xl p-6 flex flex-col gap-4">
            @csrf
            @method('PUT')

            <h2 class="text-xl font-semibold text-gray-800">Update User Info</h2>

            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required
                       class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required
                       class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>

            @if($user->hasRole('service_provider'))
                <div>
                    <label for="role" class="block font-medium text-gray-700">Role</label>
                    <select name="role" id="role"
                            class="w-full border border-gray-300 rounded-md p-2 mt-1 bg-white focus:ring focus:ring-blue-200">
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->roles->first()?->name === $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" value="client" name="role">
            @endif

            <button type="submit"
                    class="bg-green-500 hover:bg-blue-600 text-white rounded-xl p-3 transition cursor-pointer">
                Update User
            </button>
        </form>

        {{-- Delete User Form --}}
        <form action="{{ route('portal.user.destroy', ['user' => $user, 'portal' => $portal]) }}"
              method="POST"
              class="bg-white shadow-xl rounded-2xl p-6 flex flex-col gap-6">
            @csrf
            @method('DELETE')

            <h2 class="text-xl font-semibold text-red-600">Delete User</h2>

            <p class="text-gray-700 text-sm">
                <i>Warning: Deleting this user will permanently remove all their associated records from the
                    database.</i>
            </p>

            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white rounded-xl p-3 transition cursor-pointer">
                Delete User
            </button>
        </form>
        <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col gap-6">
            <div class="flex flex-row items-center gap-4">
                <h2>Current profile picture</h2>
                @php
                    $file = \App\Models\File::where('filename', $user->name . $user->id . '.jpg')->first();
                @endphp
                @if($file)
                    <img src="{{ $file->url }}" alt="{{ $file->filename }}" class="w-12">
                @else
                    <img src="{{ asset('anonymous_picture.jpg') }}" alt="{{ $user->name }}" class="w-12">
                @endif
            </div>
            <form action="{{ route('portal.user.profile', ['portal' => $portal, "user" => $user]) }}" method="POST"
                  enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- File Upload -->
                <div>
                    <label for="file" class="block font-medium text-gray-700">Upload File</label>
                    <input type="file" id="file" name="file" required
                           class="w-full border border-gray-300 rounded-md p-3 mt-1 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-green-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-xl transition-colors duration-200">
                    Update profile picture
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

