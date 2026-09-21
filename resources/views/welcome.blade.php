<x-guestLayout>
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="relative h-screen overflow-hidden">
        <!-- YouTube Background -->
        <div class="absolute inset-0 overflow-hidden">
            <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline>
                <source src="{{ asset('herovideo.mp4') }}" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Content -->
        <div class="relative z-10 flex h-full items-center justify-center px-6">
            <div class="max-w-4xl text-center text-white">
                <span class="mb-6 inline-block rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold">
                    Build Professional Client Portals
                </span>

                <h1 class="mb-6 text-5xl leading-tight font-extrabold md:text-7xl">
                    Your Business.
                    <span class="text-blue-400">Your Brand.</span>
                    Your Client Portal.
                </h1>

                <p class="mx-auto mb-10 max-w-3xl text-xl text-gray-200 md:text-2xl">
                    Create beautiful branded client portals where you can securely share documents, communicate with
                    clients, and manage projects— all without writing code.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a
                        href="{{ route('portal.create') }}"
                        class="rounded-2xl bg-blue-600 px-8 py-4 font-semibold shadow-lg transition hover:bg-blue-700"
                    >
                        Get Started
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=7NKmIakO1vw"
                        target="_blank"
                        class="rounded-2xl border-2 border-white px-8 py-4 font-semibold transition hover:bg-white hover:text-black"
                    >
                        Watch Demo
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Audience Section -->
    <section class="bg-white px-6 py-20 md:px-28">
        <h2 class="mb-12 text-4xl font-extrabold text-blue-900">Who is this for?</h2>
        <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset('freelancer.jpg') }}"
                        alt="freelancers"
                        class="h-14 w-14 rounded-full border-2 border-blue-600 object-cover"
                    />
                    <span class="text-xl text-blue-800">Freelancers</span>
                </div>
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset('creativeagency.jpg') }}"
                        alt="Creative agencies"
                        class="h-14 w-14 rounded-full border-2 border-blue-600 object-cover"
                    />
                    <span class="text-xl text-blue-800">Creative agencies</span>
                </div>
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset('consultant.jpg') }}"
                        alt="Consultants"
                        class="h-14 w-14 rounded-full border-2 border-blue-600 object-cover"
                    />
                    <span class="text-xl text-blue-800">Consultants</span>
                </div>
            </div>
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset('legal.jpeg') }}"
                        alt="Legal & financial service providers"
                        class="h-14 w-14 rounded-full border-2 border-blue-600 object-cover"
                    />
                    <span class="text-xl text-blue-800">Legal & financial service providers</span>
                </div>
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset('coach.jpg') }}"
                        alt="Coaches & trainers"
                        class="h-14 w-14 rounded-full border-2 border-blue-600 object-cover"
                    />
                    <span class="text-xl text-blue-800">Coaches & trainers</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem/Solution Section -->
    <section class="bg-blue-50 px-6 py-20 md:px-28">
        <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2">
            <img src="{{ asset('central.png') }}" alt="Illustration of a problem" class="w-full rounded-xl shadow-lg" />
            <div class="flex flex-col gap-8">
                <h2 class="text-4xl font-extrabold text-blue-900">Why a client portal?</h2>
                <p class="text-lg leading-relaxed text-blue-800 md:text-xl">
                    Many service providers don’t have a central place to communicate with their clients.<br />
                    Portalease gives your clients a safe, organized place for collaboration, documents, and updates.
                </p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white px-6 py-20 md:px-28">
        <div class="grid grid-cols-1 items-start gap-12 md:grid-cols-2">
            <div class="flex flex-col gap-6">
                <h2 class="text-4xl font-extrabold text-blue-900">No technical knowledge required</h2>
                <p class="text-lg text-blue-800 md:text-xl">
                    You don’t need developers or expensive systems. Get started within 5 minutes and give your clients
                    the experience they deserve.
                </p>
            </div>
            <ul class="list-none space-y-3 text-lg text-blue-900 md:text-xl">
                <li>🔹 Personalized portal with your own branding</li>
                <li>🔹 Share documents, invoices, and updates securely</li>
                <li>🔹 Communicate clearly via messages</li>
                <li>🔹 Invite clients with one click</li>
                <li>🔹 Collaborate with your team – everything in one place</li>
            </ul>
        </div>
    </section>
    <!-- Everything Included -->
    <section class="bg-blue-50 px-6 py-20 md:px-28">
        <div class="mx-auto max-w-5xl text-center">
            <h2 class="mb-6 text-4xl font-extrabold text-blue-900">Everything You Need to Manage Your Clients</h2>

            <p class="mx-auto mb-12 max-w-3xl text-lg text-blue-800">
                PortalEase provides everything you need to communicate, collaborate, and share information with your
                clients in one secure, organized portal.
            </p>

            <div class="grid grid-cols-1 gap-8 text-left md:grid-cols-3">
                <div class="rounded-2xl bg-white p-6 shadow-lg">
                    <div class="mb-4 text-3xl">📁</div>
                    <h3 class="mb-3 text-xl font-bold text-blue-900">Secure Document Sharing</h3>
                    <p class="text-blue-700">Upload, organize, and securely share documents with your clients.</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-lg">
                    <div class="mb-4 text-3xl">💬</div>
                    <h3 class="mb-3 text-xl font-bold text-blue-900">Client Communication</h3>
                    <p class="text-blue-700">Keep every conversation in one place with built-in messaging.</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-lg">
                    <div class="mb-4 text-3xl">📊</div>
                    <h3 class="mb-3 text-xl font-bold text-blue-900">Project Management</h3>
                    <p class="text-blue-700">Track projects, updates, and client progress from a single dashboard.</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-lg">
                    <div class="mb-4 text-3xl">🎨</div>
                    <h3 class="mb-3 text-xl font-bold text-blue-900">Custom Branding</h3>
                    <p class="text-blue-700">Personalize your portal with your own logo, colors, and branding.</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-lg">
                    <div class="mb-4 text-3xl">👥</div>
                    <h3 class="mb-3 text-xl font-bold text-blue-900">Team Collaboration</h3>
                    <p class="text-blue-700">Work together with your team while keeping clients informed.</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-lg">
                    <div class="mb-4 text-3xl">🚀</div>
                    <h3 class="mb-3 text-xl font-bold text-blue-900">Ready in Minutes</h3>
                    <p class="text-blue-700">
                        Create your portal and invite clients within minutes—no technical knowledge required.
                    </p>
                </div>
            </div>

            <div class="mt-12">
                <a
                    href="{{ route('portal.create') }}"
                    class="rounded-2xl bg-blue-600 px-8 py-3 font-semibold text-white shadow-lg transition hover:bg-blue-700"
                >
                    Create Your Portal
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 px-6 py-20 text-center text-white md:px-28">
        <h2 class="mb-4 text-4xl font-extrabold">Leave emails, Dropbox links, and scattered PDFs behind.</h2>
        <p class="mb-8 text-lg md:text-xl">Start today with your own client portal.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a
                href="{{ route('portal.index') }}"
                class="rounded-2xl bg-white px-6 py-3 font-semibold text-blue-700 shadow transition hover:bg-blue-100"
            >
                Try for free
            </a>
            <a
                href="https://www.youtube.com/watch?v=7NKmIakO1vw"
                class="rounded-2xl border-2 border-white bg-transparent px-6 py-3 font-semibold transition hover:bg-white hover:text-blue-700"
            >
                View demo
            </a>
        </div>
    </section>
</x-guestLayout>
