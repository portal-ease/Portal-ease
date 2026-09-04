<x-guestLayout>
    <section class="bg-blue-50 py-16 px-6 md:px-28 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4">
            Create Your Client Portal
        </h1>
        <p class="text-lg md:text-xl text-blue-800 max-w-2xl mx-auto">
            Step 1 of 2 — Portal Setup
        </p>
    </section>

    <section class="max-w-2xl mx-auto px-6 md:px-12 py-12">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <form method="POST" action="{{ route('portal.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Portal Name -->
                <div>
                    <label for="name" class="block font-medium text-gray-700 mb-1">Portal Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="e.g. Acme Client Portal">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1">Contact Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="e.g. contact@yourbusiness.com">
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="Choose a username">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="Create a secure password">
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" id="color-picker-1"
                        class="w-10 h-10 rounded-lg border border-gray-300 shadow-sm"
                        aria-label="Choose branding colour">
                    </button>
                    <input type="text" id="branding" name="branding_color" value="#3B82F6" required readonly
                        class="flex-1 border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200">
                </div>

                <!-- Logo Upload -->
                <div>
                    <label for="logo" class="block font-medium text-gray-700 mb-1">Portal Logo</label>
                    <input type="file" id="logo" name="logo" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition">
                    -> Next step
                </button>
            </form>
        </div>
    </section>
</x-guestLayout>
