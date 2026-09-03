<x-guestLayout>

    <div class="max-w-md mb-6 mx-auto bg-white shadow-2xl rounded-2xl p-10 mt-12">

        <h1 class="text-2xl font-bold text-gray-800">
            Forgot your password?
        </h1>

        <p class="text-gray-500 mt-2">
            Enter your email address and we'll send you a reset link.
        </p>

        @if (session('status'))
            <div class="mt-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email', currentPortal()) }}" class="mt-6">

            @csrf

            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address" required
                class="w-full border border-gray-300 rounded-lg p-3 mt-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

            @error('email')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-3 rounded-lg cursor-pointer">
                Send Reset Link
            </button>

        </form>

    </div>

</x-guestLayout>
