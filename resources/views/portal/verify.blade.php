<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-blue-50 py-16 px-6 md:px-28 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4">
            Verify Your Email
        </h1>

        <p class="text-lg md:text-xl text-blue-800 max-w-2xl mx-auto">
            You're almost there! Please verify your email address to activate your account.
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

            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Check Your Inbox
            </h2>

            <p class="text-gray-600 mb-6">
                We've sent a verification email to
                <strong>{{ auth()->user()->email }}</strong>.
                Click the verification link in the email to continue.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    A new verification email has been sent.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition">
                    Resend Verification Email
                </button>
            </form>

        </div>
    </section>
</x-guestLayout>
