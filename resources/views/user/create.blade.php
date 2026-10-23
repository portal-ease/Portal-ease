<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:py-12">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-200 bg-gray-50/80 px-6 py-6 sm:px-8">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                        <x-lucide-user-plus class="h-6 w-6"/>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900">
                            Register new user
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Invite a user to access this portal.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form
                action="{{ route('portal.user.store', ['portal' => currentPortal()]) }}"
                method="POST"
                class="space-y-6 p-6 sm:p-8"
            >
                @csrf

                <input
                    type="hidden"
                    name="portal_id"
                    value="{{ currentPortal()->id }}"
                />

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Email address
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <x-lucide-mail
                            class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                        />

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="name@example.com"
                            aria-describedby="email-help"
                            @class([
                                'w-full rounded-xl border bg-white py-3 pl-11 pr-4 text-sm text-gray-900 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10',
                                'border-red-300' => $errors->has('email'),
                                'border-gray-300' => !$errors->has('email'),
                            ])
                        />

                    </div>

                    <p id="email-help" class="mt-2 text-xs text-gray-500">
                        An activation email will be sent to this address.
                    </p>

                    @error('email')
                    <p class="mt-2 flex items-center gap-1.5 text-sm text-red-600">
                        <i data-lucide="circle-alert" class="h-4 w-4"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label
                        for="role"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        User role
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <x-lucide-shield-check
                            class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                        />

                        <select
                            name="role"
                            id="role"
                            required
                            class="w-full appearance-none rounded-xl border border-gray-300 bg-white py-3 pl-11 pr-10 text-sm text-gray-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                @if ($role->name !== 'admin')
                                    <option
                                        value="{{ $role->name }}"
                                        @selected(old('role') === $role->name)
                                    >
                                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>

                        <x-lucide-chevron-down
                            class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                        />
                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        The selected role determines the user's permissions.
                    </p>

                    @error('role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Invitation notice --}}
                <div class="flex gap-3 rounded-xl border border-blue-100 bg-blue-50 p-4">
                    <x-lucide-info
                        class="mt-0.5 h-5 w-5 shrink-0 text-blue-600"
                    />

                    <div>
                        <p class="text-sm font-medium text-blue-900">
                            What happens next?
                        </p>
                        <p class="mt-1 text-sm leading-5 text-blue-700">
                            The invited user receives an email with instructions
                            to activate their account.
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">
                    <a
                        href="{{ url()->previous() }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-100"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                    >
                        <x-lucide-send class="h-4 w-4"/>
                        Send activation email
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
