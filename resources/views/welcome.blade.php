<x-guestLayout>
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="relative h-screen overflow-hidden">

        <!-- YouTube Background -->
        <div class="absolute inset-0 overflow-hidden">
            <iframe
                class="absolute top-1/2 left-1/2 w-[177.78vh] h-[56.25vw] min-w-full min-h-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"
                src="https://www.youtube.com/embed/7NKmIakO1vw?autoplay=1&mute=1&controls=0&loop=1&playlist=7NKmIakO1vw&showinfo=0&rel=0&modestbranding=1"
                title="PortalEase Demo"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/70"></div>

        <!-- Content -->
        <div class="relative z-10 flex items-center justify-center h-full px-6">
            <div class="max-w-4xl text-center text-white">

            <span class="inline-block mb-6 px-4 py-2 rounded-full bg-blue-600 text-sm font-semibold">
                Build Professional Client Portals
            </span>

                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6">
                    Your Business.
                    <span class="text-blue-400">Your Brand.</span>
                    Your Client Portal.
                </h1>

                <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-10">
                    Create beautiful branded client portals where you can securely
                    share documents, communicate with clients, and manage projects—
                    all without writing code.
                </p>

                <div class="flex justify-center gap-4 flex-wrap">
                    <a href="{{ route('portal.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 transition px-8 py-4 rounded-2xl font-semibold shadow-lg">
                        Get Started
                    </a>

                    <a href="https://www.youtube.com/watch?v=7NKmIakO1vw"
                       target="_blank"
                       class="border-2 border-white hover:bg-white hover:text-black transition px-8 py-4 rounded-2xl font-semibold">
                        Watch Demo
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Audience Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 mb-12">Who is this for?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('freelancer.jpg') }}" alt="freelancers"
                         class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                    <span class="text-xl text-blue-800">Freelancers</span>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('creativeagency.jpg') }}" alt="Creative agencies"
                         class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                    <span class="text-xl text-blue-800">Creative agencies</span>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('consultant.jpg') }}" alt="Consultants"
                         class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                    <span class="text-xl text-blue-800">Consultants</span>
                </div>
            </div>
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('legal.jpeg') }}" alt="Legal & financial service providers"
                         class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                    <span class="text-xl text-blue-800">Legal & financial service providers</span>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('coach.jpg') }}" alt="Coaches & trainers"
                         class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                    <span class="text-xl text-blue-800">Coaches & trainers</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem/Solution Section -->
    <section class="bg-blue-50 py-20 px-6 md:px-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <img src="{{ asset('central.png') }}" alt="Illustration of a problem"
                 class="w-full rounded-xl shadow-lg">
            <div class="flex flex-col gap-8">
                <h2 class="text-4xl font-extrabold text-blue-900">Why a client portal?</h2>
                <p class="text-lg md:text-xl text-blue-800 leading-relaxed">
                    Many service providers don’t have a central place to communicate with their clients.<br>
                    Portalease gives your clients a safe, organized place for collaboration, documents, and updates.
                </p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div class="flex flex-col gap-6">
                <h2 class="text-4xl font-extrabold text-blue-900">No technical knowledge required</h2>
                <p class="text-lg md:text-xl text-blue-800">
                    You don’t need developers or expensive systems. Get started within 5 minutes and give your clients
                    the experience they deserve.
                </p>
            </div>
            <ul class="text-lg md:text-xl text-blue-900 space-y-3 list-none">
                <li>🔹 Personalized portal with your own branding</li>
                <li>🔹 Share documents, invoices, and updates securely</li>
                <li>🔹 Communicate clearly via messages</li>
                <li>🔹 Invite clients with one click</li>
                <li>🔹 Collaborate with your team – everything in one place</li>
            </ul>
        </div>
    </section>
    <!-- Everything Included -->
    <section class="bg-blue-50 py-20 px-6 md:px-28">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-blue-900 mb-6">
                Everything You Need to Manage Your Clients
            </h2>

            <p class="text-lg text-blue-800 mb-12 max-w-3xl mx-auto">
                PortalEase provides everything you need to communicate, collaborate,
                and share information with your clients in one secure, organized portal.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl mb-4">📁</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">
                        Secure Document Sharing
                    </h3>
                    <p class="text-blue-700">
                        Upload, organize, and securely share documents with your clients.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl mb-4">💬</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">
                        Client Communication
                    </h3>
                    <p class="text-blue-700">
                        Keep every conversation in one place with built-in messaging.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">
                        Project Management
                    </h3>
                    <p class="text-blue-700">
                        Track projects, updates, and client progress from a single dashboard.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl mb-4">🎨</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">
                        Custom Branding
                    </h3>
                    <p class="text-blue-700">
                        Personalize your portal with your own logo, colors, and branding.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl mb-4">👥</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">
                        Team Collaboration
                    </h3>
                    <p class="text-blue-700">
                        Work together with your team while keeping clients informed.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl mb-4">🚀</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">
                        Ready in Minutes
                    </h3>
                    <p class="text-blue-700">
                        Create your portal and invite clients within minutes—no technical knowledge required.
                    </p>
                </div>
            </div>

            <div class="mt-12">
                <a href="{{ route('portal.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-8 rounded-2xl shadow-lg">
                    Create Your Portal
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-4">Leave emails, Dropbox links, and scattered PDFs behind.</h2>
        <p class="text-lg md:text-xl mb-8">Start today with your own client portal.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('portal.index') }}"
               class="bg-white text-blue-700 hover:bg-blue-100 transition font-semibold py-3 px-6 rounded-2xl shadow">
                Try for free
            </a>
            <a href="https://www.youtube.com/watch?v=7NKmIakO1vw"
               class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-700 font-semibold py-3 px-6 rounded-2xl transition">
                View demo
            </a>
        </div>
    </section>
</x-guestLayout>
