<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-blue-50 py-16 px-6 md:px-28 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4">
            Verify Your Email
        </h1>
        <p class="text-lg md:text-xl text-blue-800 max-w-2xl mx-auto">
            Step 2 of 2 — Confirm your email to finish setting up your portal
        </p>
    </section>

    <!-- Verification Box -->
    <section class="max-w-xl mx-auto px-6 md:px-12 py-12">
        <div class="bg-white rounded-2xl shadow-2xl p-10 text-center">
            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-4xl">
                    📧
                </div>
            </div>

            <!-- Message -->
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Check Your Inbox</h2>
            <p class="text-gray-600 mb-8">
                We’ve sent a verification link to <strong>{{ session('email') }}</strong>.
                Please click the link in the email to activate your portal.
            </p>
            <a href="{{ route('portal.show', $portal) }}"
               class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition">
                Skip step and verify later
            </a>

            <!-- Resend Option -->
            <div class="mt-6 text-sm text-gray-500">
                Didn’t get the email?
                <a href="/" class="text-blue-600 hover:underline">
                    Resend verification link
                </a>
            </div>
        </div>
    </section>
</x-guestLayout>
