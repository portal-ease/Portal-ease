<x-guestLayout>
    <div class="mx-auto mt-12 mb-4 max-w-md rounded-2xl bg-white p-10 shadow-2xl">
        <h1 class="text-2xl font-bold text-gray-800">Reset Password</h1>

        <form method="POST" action="{{ route('password.update', ['portal' => currentPortal()]) }}" class="mt-6">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}" />

            <input
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                placeholder="Email address"
                required
                class="mt-1 w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />

            <input
                type="password"
                name="password"
                placeholder="New password"
                required
                class="mt-1 w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />

            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

            <input
                type="password"
                name="password_confirmation"
                placeholder="Confirm new password"
                required
                class="mt-4 w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />

            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
            <button type="submit" class="w-full rounded-lg bg-blue-600 py-3 text-white">Reset Password</button>
        </form>
    </div>
</x-guestLayout>
