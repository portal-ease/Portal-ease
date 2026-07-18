<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white py-28 px-6">

        <div class="max-w-5xl mx-auto text-center">

            <span class="inline-block px-4 py-2 rounded-full bg-blue-500/30 text-sm font-semibold">
                About PortalEase
            </span>

            <h1 class="text-5xl md:text-6xl font-extrabold mt-6 mb-6">
                We're building the easiest way
                to collaborate with your clients.
            </h1>

            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                PortalEase helps businesses deliver a professional client experience
                through secure communication, document sharing, and project collaboration—
                all from one centralized portal.
            </p>

        </div>

    </section>

    <!-- Mission Section -->
    <section class="max-w-6xl mx-auto px-6 md:px-12 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <img src="{{ asset('about.png') }}" alt="Our Mission" class="rounded-2xl shadow-xl w-full object-cover">
        <div class="flex flex-col gap-6">
            <h2 class="text-3xl font-extrabold text-blue-900">Why We Built PortalEase</h2>
            <p class="text-lg text-blue-800 leading-relaxed">
                Managing clients often means juggling emails, cloud storage, spreadsheets, and messaging apps.
                We wanted a simpler solution—a single place where businesses and clients can collaborate securely and
                efficiently.
            </p>
            <p class="text-lg text-blue-800 leading-relaxed">
                PortalEase brings communication, documents, projects, and collaboration together in one intuitive
                platform,
                helping businesses save time while delivering a better client experience.
            </p>
        </div>
    </section>

    <!-- Values Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-3xl font-extrabold text-blue-900 text-center mb-12">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-blue-50 rounded-2xl shadow-md p-8 text-center hover:shadow-xl transition">
                <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Simplicity</h3>
                <p class="text-blue-800">
                    Technology should be easy. We keep our platform intuitive so you can focus on your work, not setup.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl shadow-md p-8 text-center hover:shadow-xl transition">
                <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14v4m0 0H8m4 0h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Transparency</h3>
                <p class="text-blue-800">
                    Clear pricing, clear communication, clear results. We believe in being open and honest with our
                    users.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl shadow-md p-8 text-center hover:shadow-xl transition">
                <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Growth</h3>
                <p class="text-blue-800">
                    We’re here to help you grow your business by offering tools that scale with you.
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">

        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-16">

                <h2 class="text-4xl font-bold text-blue-900">
                    What You Can Do With PortalEase
                </h2>

                <p class="text-blue-700 mt-4">
                    Everything you need to work together with your clients.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-blue-50 p-8 rounded-2xl">
                    <div class="text-4xl mb-4">📁</div>
                    <h3 class="font-bold text-xl">Document Sharing</h3>
                </div>

                <div class="bg-blue-50 p-8 rounded-2xl">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="font-bold text-xl">Messaging</h3>
                </div>

                <div class="bg-blue-50 p-8 rounded-2xl">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="font-bold text-xl">Projects</h3>
                </div>

                <div class="bg-blue-50 p-8 rounded-2xl">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="font-bold text-xl">Custom Branding</h3>
                </div>

            </div>

        </div>

    </section>

    <!-- Team Section -->
    <section class="bg-blue-50 py-20 px-6 md:px-28">
        <h2 class="text-3xl font-extrabold text-blue-900 text-center mb-12">Meet the People Behind PortalEase</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
            <a class="flex flex-col items-center text-center"
                href="https://www.linkedin.com/in/stijn-janssen-ba1920287">
                <img src="{{ asset('stijn.jpg') }}" alt="Team member"
                    class="w-32 h-32 rounded-full mb-4 shadow-lg object-cover">
                <h3 class="text-xl font-bold text-blue-900">Stijn Janssen</h3>
                <p class="text-blue-700">Founder & Lead Developer</p>
            </a>
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('anonymous_picture.jpg') }}" alt="Team member"
                    class="w-32 h-32 rounded-full mb-4 shadow-lg object-cover">
                <h3 class="text-xl font-bold text-blue-900">Join Our Journey</h3>
                <p class="text-blue-700">Interested in contributing or partnering with us? <br>
                    We'd love to hear from you.</p>
            </div>
        </div>
    </section>

    <section class="bg-blue-50 py-20">

        <div class="max-w-6xl mx-auto grid md:grid-cols-4 text-center gap-10">

            <div>
                <h3 class="text-5xl font-bold text-blue-700">1</h3>
                <p>Platform</p>
            </div>

            <div>
                <h3 class="text-5xl font-bold text-blue-700">100%</h3>
                <p>Web Based</p>
            </div>

            <div>
                <h3 class="text-5xl font-bold text-blue-700">24/7</h3>
                <p>Available</p>
            </div>

            <div>
                <h3 class="text-5xl font-bold text-blue-700">∞</h3>
                <p>Possibilities</p>
            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="bg-blue-700 py-24 text-center text-white">

        <h2 class="text-5xl font-bold mb-6">
            Ready to transform the way you work with clients?
        </h2>

        <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-10">
            Join businesses that are simplifying communication, organizing projects,
            and delivering a professional client experience with PortalEase.
        </p>

        <a href="{{ route('portal.create') }}"
            class="bg-white text-blue-700 px-8 py-4 rounded-2xl font-semibold hover:bg-blue-100 transition">
            Create Your Portal
        </a>

    </section>
</x-guestLayout>
