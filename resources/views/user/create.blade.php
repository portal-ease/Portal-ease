<x-app-layout :portal="$portal">
    <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-6">
        <h2 class="text-2xl font-semibold text-gray-800">Register New Customer</h2>

        <form action="{{ route('portal.user.store', ['portal' => $portal]) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required
                       class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                       placeholder="Customer name">
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required
                       class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                       placeholder="Email address">
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                       placeholder="Password">
            </div>

            <input type="hidden" name="portal_id" value="{{ $portal->id }}">

            <div>
                <label for="role" class="block font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                        class="w-full border border-gray-300 rounded-md p-2 mt-1 bg-white focus:ring focus:ring-blue-200">
                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                        @if($role->name != "admin")
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="w-full bg-green-500 text-white p-3 rounded-xl hover:bg-blue-600 transition">
                Register
            </button>
        </form>
    </div>
</x-app-layout>
