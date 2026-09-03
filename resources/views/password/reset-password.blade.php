<x-guestLayout>

    <div class="max-w-md mx-auto bg-white shadow-2xl rounded-2xl p-10 mt-12 mb-4">

        <h1 class="text-2xl font-bold text-gray-800">
            Reset Password
        </h1>

        <form method="POST"
              action="{{ route('password.update', ['portal' => currentPortal()]) }}"
              class="mt-6">

            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                placeholder="Email address"
                required
                class="w-full border border-gray-300 rounded-lg p-3 mt-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            <input
                type="password"
                name="password"
                placeholder="New password"
                required
                class="w-full border border-gray-300 rounded-lg p-3 mt-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            @error('password')
            <p class="text-red-500 text-sm mt-2">
                {{ $message }}
            </p>
            @enderror

            <input
                type="password"
                name="password_confirmation"
                placeholder="Confirm new password"
                required
                class="w-full border border-gray-300 rounded-lg p-3 mt-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            @error('password_confirmation')
            <p class="text-red-500 text-sm mt-2">
                {{ $message }}
            </p>
            @enderror
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg"
            >
                Reset Password
            </button>

        </form>

    </div>

</x-guestLayout>
