@php
    use App\Services\FileStorageService;
@endphp
<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-blue-50 py-20 px-6 md:px-28 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4">Explore Our Client Portals</h1>
        <p class="text-lg md:text-xl text-blue-800 max-w-2xl mx-auto">
            Browse through the portals we’ve created for businesses and teams.
            Each portal provides a secure and organized space for collaboration.
        </p>
    </section>

    <!-- Portal Grid -->
    <section class="max-w-7xl mx-auto px-6 md:px-12 py-16">
        @if (\App\Models\Portal::count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach (\App\Models\Portal::all() as $portal)
                    @php
                        $logoPath = app(FileStorageService::class)->portalLogoUrl($portal);
                    @endphp
                    <a class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition border border-blue-100 hover:border-blue-300 p-6 flex flex-col items-center text-center"
                        href="{{ route('portal.show', $portal) }}">
                        <!-- Placeholder for portal logo -->
                        <img class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-4"
                            src="{{ $logoPath ?? asset('portalEaseLogo.png') }}" alt="{{ $portal->name }}">
                        <!-- Portal Title -->
                        <h3 class="text-xl font-bold text-blue-900 mb-2 group-hover:text-blue-700 transition">
                            {{ $portal->name }}</h3>
                        <p class="text-blue-800 text-sm mb-4">Secure, branded space for clients to collaborate and share
                            files.</p>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center bg-blue-50 border border-blue-200 rounded-xl p-12 shadow-inner">
                <h3 class="text-2xl font-bold text-blue-800 mb-2">No portals available</h3>
                <p class="text-blue-700 mb-6">Check back soon! We’re adding more client portals.</p>
            </div>
        @endif
    </section>

    <!-- Call to Action (Optional for Signups) -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-4">Want your own client portal?</h2>
        <p class="text-lg md:text-xl mb-8">We can set up a secure and branded portal for your business in minutes.</p>
        <a href="{{ route('portal.create') }}"
            class="bg-white text-blue-700 hover:bg-blue-100 transition font-semibold py-3 px-6 rounded-2xl shadow">
            Get Started
        </a>
    </section>
</x-guestLayout>
