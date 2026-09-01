<x-app-layout :portal="currentPortal()">
    <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-2xl p-10 space-y-8">
        <h2 class="text-3xl font-bold text-center text-gray-800">Start New Project</h2>

        <form method="POST" action="{{ route('portal.project.store', currentPortal()) }}" class="space-y-6">
            @csrf

            <!-- Project Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter project name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Customer Email/User -->
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                <select name="customer_id" id="customer_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="" disabled selected>Select a user</option>
                    @foreach (currentPortal()->users as $user)
                        @if ($user->hasRole('client'))
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" id="end_date" name="end_date" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl px-6 py-3 transition-colors duration-300">
                    Create Project
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
