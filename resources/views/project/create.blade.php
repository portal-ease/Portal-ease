<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-xl space-y-8 rounded-2xl bg-white p-10 shadow-2xl">
        <h2 class="text-center text-3xl font-bold text-gray-800">Start New Project</h2>

        <form method="POST" action="{{ route('portal.project.store', currentPortal()) }}" class="space-y-6">
            @csrf

            <!-- Project Name -->
            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Project Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    placeholder="Enter project name"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                />
            </div>

            <!-- Customer Email/User -->
            <div>
                <label for="customer_id" class="mb-1 block text-sm font-medium text-gray-700">Customer</label>
                <select
                    name="customer_id"
                    id="customer_id"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                >
                    <option value="" disabled selected>Select a user</option>
                    @foreach (currentPortal()->users as $user)
                        @if ($user->hasRole('client'))
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="start_date" class="mb-1 block text-sm font-medium text-gray-700">Start Date</label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    />
                </div>
                <div>
                    <label for="end_date" class="mb-1 block text-sm font-medium text-gray-700">End Date</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    />
                </div>
            </div>
            <div>
                <button
                    type="submit"
                    class="w-full rounded-xl bg-green-600 px-6 py-3 font-semibold text-white transition-colors duration-300 hover:bg-green-700"
                >
                    Create Project
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
