<x-app-layout :portal="currentPortal()">
    <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-6">
        <h2 class="text-2xl font-semibold text-gray-800">Share a Document</h2>

        <form action="{{ route('portal.file.store', ['portal' => currentPortal()]) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <!-- Document Name -->
            <div>
                <label for="name" class="block font-medium text-gray-700">Document Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full border border-gray-300 rounded-md p-3 mt-1 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="e.g., Contract, Report, Terms">
            </div>

            <!-- File Upload -->
            <div>
                <label for="file" class="block font-medium text-gray-700">Upload File</label>
                <input type="file" id="file" name="file" required
                    class="w-full border border-gray-300 rounded-md p-3 mt-1 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <!-- Share With -->
            <div>
                <label for="user" class="block font-medium text-gray-700">Share With</label>
                <select name="user" id="user" required
                    class="w-full border border-gray-300 rounded-md p-3 mt-1 bg-white focus:ring focus:ring-blue-200 focus:outline-none">
                    @foreach (currentPortal()->users as $user)
                        @if ($user->hasRole('client'))
                            <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Visibility -->
            <div>
                <label for="visibility" class="block font-medium text-gray-700">Visibility</label>
                <select name="visibility" id="visibility" required
                    class="w-full border border-gray-300 rounded-md p-3 mt-1 bg-white focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="visible">Visible</option>
                    <option value="not visible">Not Visible</option>
                </select>
            </div>

            <input type="hidden" name="portal_id" value="{{ currentPortal()->id }}">

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-green-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-xl transition-colors duration-200">
                Share Document
            </button>
        </form>
    </div>
</x-app-layout>
