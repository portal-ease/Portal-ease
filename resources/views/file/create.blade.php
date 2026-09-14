<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-xl space-y-6 rounded-2xl bg-white p-8 shadow-2xl">
        <h2 class="text-2xl font-semibold text-gray-800">Share a Document</h2>

        <form
            action="{{ route('portal.file.store', ['portal' => currentPortal()]) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf

            <!-- Document Name -->
            <div>
                <label for="name" class="block font-medium text-gray-700">Document Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-3 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="e.g., Contract, Report, Terms"
                />
            </div>

            <!-- File Upload -->
            <div>
                <label for="file" class="block font-medium text-gray-700">Upload File</label>
                <input
                    type="file"
                    id="file"
                    name="file"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-3 focus:ring focus:ring-blue-200 focus:outline-none"
                />
            </div>

            <!-- Share With -->
            <div>
                <label for="user" class="block font-medium text-gray-700">Share With</label>
                <select
                    name="user"
                    id="user"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white p-3 focus:ring focus:ring-blue-200 focus:outline-none"
                >
                    @foreach (currentPortal()->users as $user)
                        @if ($user->hasRole('client'))
                            <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Visibility -->
            <div>
                <label for="visibility" class="flex flex-row gap-4 font-medium text-gray-700"
                    >Visible for client?<input type="checkbox" name="visibility" id="visibility"
                /></label>
            </div>

            <input type="hidden" name="portal_id" value="{{ currentPortal()->id }}" />

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full rounded-xl bg-green-500 py-3 font-semibold text-white transition-colors duration-200 hover:bg-blue-600"
            >
                Share Document
            </button>
        </form>
    </div>
</x-app-layout>
