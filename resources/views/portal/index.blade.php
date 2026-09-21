@php
    use App\Services\FileStorageService;
@endphp
<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-blue-50 px-6 py-20 text-center md:px-28">
        <h1 class="mb-4 text-4xl font-extrabold text-blue-900 md:text-5xl">Explore Our Client Portals</h1>
        <p class="mx-auto max-w-2xl text-lg text-blue-800 md:text-xl">
            Browse through the portals we’ve created for businesses and teams. Each portal provides a secure and
            organized space for collaboration.
        </p>
    </section>

    <!-- Portal Grid -->
    <section class="mx-auto max-w-7xl px-6 py-16 md:px-12">
        @if (\App\Models\Portal::count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (\App\Models\Portal::all() as $portal)
                    @php
                        $logoPath = app(FileStorageService::class)->portalLogoUrl($portal);
                    @endphp
                    <a
                        class="group flex flex-col items-center rounded-2xl border border-blue-100 bg-white p-6 text-center shadow-lg transition hover:border-blue-300 hover:shadow-2xl"
                        href="{{ route('portal.show', $portal) }}"
                    >
                        <!-- Placeholder for portal logo -->
                        <img
                            class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-blue-100"
                            src="{{ $logoPath ?? asset('portalEaseLogo.png') }}"
                            alt="{{ $portal->name }}"
                        />
                        <!-- Portal Title -->
                        <h3 class="mb-2 text-xl font-bold text-blue-900 transition group-hover:text-blue-700">
                            {{ $portal->name }}
                        </h3>
                        <p class="mb-4 text-sm text-blue-800">
                            Secure, branded space for clients to collaborate and share files.
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="rounded-xl border border-blue-200 bg-blue-50 p-12 text-center shadow-inner">
                <h3 class="mb-2 text-2xl font-bold text-blue-800">No portals available</h3>
                <p class="mb-6 text-blue-700">Check back soon! We’re adding more client portals.</p>
            </div>
        @endif
    </section>

    <!-- Call to Action (Optional for Signups) -->
    <section class="bg-blue-600 px-6 py-20 text-center text-white md:px-28">
        <h2 class="mb-4 text-4xl font-extrabold">Want your own client portal?</h2>
        <p class="mb-8 text-lg md:text-xl">We can set up a secure and branded portal for your business in minutes.</p>
        <a
            href="{{ route('portal.create') }}"
            class="rounded-2xl bg-white px-6 py-3 font-semibold text-blue-700 shadow transition hover:bg-blue-100"
        >
            Get Started
        </a>
    </section>
</x-guestLayout>
