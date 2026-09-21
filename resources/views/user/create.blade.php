<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-xl space-y-6 rounded-2xl bg-white p-8 shadow-2xl">
        <h2 class="text-2xl font-semibold text-gray-800">Register New Customer</h2>

        <form action="{{ route('portal.user.store', ['portal' => currentPortal()]) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="Customer name"
                />
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="Email address"
                />
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="Password"
                />
            </div>

            <input type="hidden" name="portal_id" value="{{ currentPortal()->id }}" />

            <div>
                <label for="role" class="block font-medium text-gray-700">Role</label>
                <select
                    name="role"
                    id="role"
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white p-2 focus:ring focus:ring-blue-200"
                >
                    @foreach (\Spatie\Permission\Models\Role::all() as $role)
                        @if ($role->name != 'admin')
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full rounded-xl bg-green-500 p-3 text-white transition hover:bg-blue-600">
                Register
            </button>
        </form>
    </div>
</x-app-layout>
