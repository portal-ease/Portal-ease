<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-blue-50 px-6 py-16 text-center md:px-28">
        <h1 class="mb-4 text-4xl font-extrabold text-blue-900 md:text-5xl">Verify Your Email</h1>

        <p class="mx-auto max-w-2xl text-lg text-blue-800 md:text-xl">
            You're almost there! Please verify your email address to activate your account.
        </p>
    </section>

    <!-- Verification Box -->
    <section class="mx-auto max-w-xl px-6 py-12 md:px-12">
        <div class="rounded-2xl bg-white p-10 text-center shadow-2xl">
            <!-- Icon -->
            <div class="mb-6 flex justify-center">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-100 text-4xl text-blue-600">
                    📧
                </div>
            </div>

            <h2 class="mb-4 text-2xl font-bold text-gray-900">Check Your Inbox</h2>

            <p class="mb-6 text-gray-600">
                We've sent a verification email to
                <strong>{{ auth()->user()->email }}</strong>. Click the verification link in the email to continue.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                    A new verification email has been sent.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white shadow-lg transition hover:bg-blue-700"
                >
                    Resend Verification Email
                </button>
            </form>
        </div>
    </section>
</x-guestLayout>
