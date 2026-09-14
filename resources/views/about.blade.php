<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-700 to-blue-900 px-6 py-28 text-white">
        <div class="mx-auto max-w-5xl text-center">
            <span class="inline-block rounded-full bg-blue-500/30 px-4 py-2 text-sm font-semibold">
                About PortalEase
            </span>

            <h1 class="mt-6 mb-6 text-5xl font-extrabold md:text-6xl">
                We're building the easiest way to collaborate with your clients.
            </h1>

            <p class="mx-auto max-w-3xl text-xl text-blue-100">
                PortalEase helps businesses deliver a professional client experience through secure communication,
                document sharing, and project collaboration— all from one centralized portal.
            </p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-12 px-6 py-16 md:grid-cols-2 md:px-12">
        <img src="{{ asset('about.png') }}" alt="Our Mission" class="w-full rounded-2xl object-cover shadow-xl" />
        <div class="flex flex-col gap-6">
            <h2 class="text-3xl font-extrabold text-blue-900">Why We Built PortalEase</h2>
            <p class="text-lg leading-relaxed text-blue-800">
                Managing clients often means juggling emails, cloud storage, spreadsheets, and messaging apps. We wanted
                a simpler solution—a single place where businesses and clients can collaborate securely and efficiently.
            </p>
            <p class="text-lg leading-relaxed text-blue-800">
                PortalEase brings communication, documents, projects, and collaboration together in one intuitive
                platform, helping businesses save time while delivering a better client experience.
            </p>
        </div>
    </section>

    <!-- Values Section -->
    <section class="bg-white px-6 py-20 md:px-28">
        <h2 class="mb-12 text-center text-3xl font-extrabold text-blue-900">Our Core Values</h2>
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
            <div class="rounded-2xl bg-blue-50 p-8 text-center shadow-md transition hover:shadow-xl">
                <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-blue-900">Simplicity</h3>
                <p class="text-blue-800">
                    Technology should be easy. We keep our platform intuitive so you can focus on your work, not setup.
                </p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-8 text-center shadow-md transition hover:shadow-xl">
                <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14v4m0 0H8m4 0h4"
                        />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-blue-900">Transparency</h3>
                <p class="text-blue-800">
                    Clear pricing, clear communication, clear results. We believe in being open and honest with our
                    users.
                </p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-8 text-center shadow-md transition hover:shadow-xl">
                <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-blue-900">Growth</h3>
                <p class="text-blue-800">
                    We’re here to help you grow your business by offering tools that scale with you.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-16 text-center">
                <h2 class="text-4xl font-bold text-blue-900">What You Can Do With PortalEase</h2>

                <p class="mt-4 text-blue-700">Everything you need to work together with your clients.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">📁</div>
                    <h3 class="text-xl font-bold">Document Sharing</h3>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">💬</div>
                    <h3 class="text-xl font-bold">Messaging</h3>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">📊</div>
                    <h3 class="text-xl font-bold">Projects</h3>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">🎨</div>
                    <h3 class="text-xl font-bold">Custom Branding</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="bg-blue-50 px-6 py-20 md:px-28">
        <h2 class="mb-12 text-center text-3xl font-extrabold text-blue-900">Meet the People Behind PortalEase</h2>
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-2">
            <a
                class="flex flex-col items-center text-center"
                href="https://www.linkedin.com/in/stijn-janssen-ba1920287"
            >
                <img
                    src="{{ asset('stijn.jpg') }}"
                    alt="Team member"
                    class="mb-4 h-32 w-32 rounded-full object-cover shadow-lg"
                />
                <h3 class="text-xl font-bold text-blue-900">Stijn Janssen</h3>
                <p class="text-blue-700">Founder & Lead Developer</p>
            </a>
            <div class="flex flex-col items-center text-center">
                <img
                    src="{{ asset('anonymous_picture.jpg') }}"
                    alt="Team member"
                    class="mb-4 h-32 w-32 rounded-full object-cover shadow-lg"
                />
                <h3 class="text-xl font-bold text-blue-900">Join Our Journey</h3>
                <p class="text-blue-700">
                    Interested in contributing or partnering with us? <br />
                    We'd love to hear from you.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-blue-50 py-20">
        <div class="mx-auto grid max-w-6xl gap-10 text-center md:grid-cols-4">
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
        <h2 class="mb-6 text-5xl font-bold">Ready to transform the way you work with clients?</h2>

        <p class="mx-auto mb-10 max-w-3xl text-xl text-blue-100">
            Join businesses that are simplifying communication, organizing projects, and delivering a professional
            client experience with PortalEase.
        </p>

        <a
            href="{{ route('portal.create') }}"
            class="rounded-2xl bg-white px-8 py-4 font-semibold text-blue-700 transition hover:bg-blue-100"
        >
            Create Your Portal
        </a>
    </section>
</x-guestLayout>
