<x-guestLayout>
    <section class="bg-blue-50 px-6 py-16 text-center md:px-28">
        <h1 class="mb-4 text-4xl font-extrabold text-blue-900 md:text-5xl">Create Your Client Portal</h1>
        <p class="mx-auto max-w-2xl text-lg text-blue-800 md:text-xl">Step 1 of 2 — Portal Setup</p>
    </section>

    <section class="mx-auto max-w-2xl px-6 py-12 md:px-12">
        <div class="rounded-2xl bg-white p-8 shadow-2xl">
            <form method="POST" action="{{ route('portal.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Portal Name -->
                <div>
                    <label for="name" class="mb-1 block font-medium text-gray-700">Portal Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="e.g. Acme Client Portal"
                    />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="mb-1 block font-medium text-gray-700">Contact Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="e.g. contact@yourbusiness.com"
                    />
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="mb-1 block font-medium text-gray-700">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="Choose a username"
                    />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="mb-1 block font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        placeholder="Create a secure password"
                    />
                </div>

                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        id="color-picker"
                        class="h-10 w-10 rounded-lg border border-gray-300 shadow-sm"
                        aria-label="Choose branding colour"
                    ></button>
                    <input
                        type="text"
                        id="branding"
                        name="branding_color"
                        value="#3B82F6"
                        required
                        readonly
                        class="flex-1 rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    />
                </div>

                <!-- Logo Upload -->
                <div>
                    <label for="logo" class="mb-1 block font-medium text-gray-700">Portal Logo</label>
                    <input
                        type="file"
                        id="logo"
                        name="logo"
                        required
                        class="w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                    />
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white shadow-lg transition hover:bg-blue-700"
                >
                    -> Next step
                </button>
            </form>
        </div>
    </section>
</x-guestLayout>
