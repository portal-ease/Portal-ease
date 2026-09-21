<x-guestLayout>
    <div class="mx-auto mt-12 mb-6 max-w-md rounded-2xl bg-white p-10 shadow-2xl">
        <h1 class="text-2xl font-bold text-gray-800">Forgot your password?</h1>

        <p class="mt-2 text-gray-500">Enter your email address and we'll send you a reset link.</p>

        @if (session('status'))
            <div class="mt-4 text-green-600">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email', currentPortal()) }}" class="mt-6">
            @csrf

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email address"
                required
                class="mt-1 w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />

            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-4 w-full cursor-pointer rounded-lg bg-blue-600 py-3 text-white">
                Send Reset Link
            </button>
        </form>
    </div>
</x-guestLayout>
