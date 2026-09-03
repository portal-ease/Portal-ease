<x-guestLayout>

    <div class="max-w-md mx-auto bg-white shadow-2xl rounded-2xl p-10 mt-12">

        <h1 class="text-2xl font-bold text-gray-800">
            Reset Password
        </h1>

        <form method="POST"
              action="{{ route('password.update') }}"
              class="mt-6">

            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                placeholder="Email address"
                required
                class="w-full mb-4 rounded-lg border-gray-300"
            >

            <input
                type="password"
                name="password"
                placeholder="New password"
                required
                class="w-full mb-4 rounded-lg border-gray-300"
            >

            <input
                type="password"
                name="password_confirmation"
                placeholder="Confirm new password"
                required
                class="w-full mb-4 rounded-lg border-gray-300"
            >

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg"
            >
                Reset Password
            </button>

        </form>

    </div>

</x-guestLayout>
