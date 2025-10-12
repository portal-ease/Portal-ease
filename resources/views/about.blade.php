<x-guestLayout>
    <!-- Hero Section -->
    <section class="bg-blue-50 py-20 px-6 md:px-28 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4">About Us</h1>
        <p class="text-lg md:text-xl text-blue-800 max-w-2xl mx-auto">
            We’re on a mission to make client communication seamless, professional,
            and stress-free for businesses of all sizes.
        </p>
    </section>

    <!-- Mission Section -->
    <section class="max-w-6xl mx-auto px-6 md:px-12 py-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <img src="{{ asset('about.png') }}" alt="Our Mission"
             class="rounded-2xl shadow-xl w-full object-cover">
        <div class="flex flex-col gap-6">
            <h2 class="text-3xl font-extrabold text-blue-900">Our Mission</h2>
            <p class="text-lg text-blue-800 leading-relaxed">
                We believe that strong client relationships start with clear communication.
                That’s why we built a simple, secure platform that gives you a professional client portal
                in minutes — no coding or expensive systems required.
            </p>
            <p class="text-lg text-blue-800 leading-relaxed">
                Our goal is to empower freelancers, agencies, and businesses to deliver an exceptional
                experience to every client they work with.
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7" />
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
                    Clear pricing, clear communication, clear results. We believe in being open and honest with our users.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl shadow-md p-8 text-center hover:shadow-xl transition">
                <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Growth</h3>
                <p class="text-blue-800">
                    We’re here to help you grow your business by offering tools that scale with you.
                </p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="bg-blue-50 py-20 px-6 md:px-28">
        <h2 class="text-3xl font-extrabold text-blue-900 text-center mb-12">Meet Our Team</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
            <a class="flex flex-col items-center text-center" href="https://www.linkedin.com/in/stijn-janssen-ba1920287">
                <img src="{{ asset('stijn.jpg') }}" alt="Team member" class="w-32 h-32 rounded-full mb-4 shadow-lg object-cover">
                <h3 class="text-xl font-bold text-blue-900">Stijn Janssen</h3>
                <p class="text-blue-700">Founder & CEO</p>
            </a>
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('anonymous_picture.jpg') }}" alt="Team member" class="w-32 h-32 rounded-full mb-4 shadow-lg object-cover">
                <h3 class="text-xl font-bold text-blue-900">Are you next?</h3>
                <p class="text-blue-700">We are always interested in new people <a href="{{ route('support') }}"><b>Contact us</b></a></p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Join us on our journey</h2>
        <p class="text-lg md:text-xl mb-8">Start creating professional client experiences today.</p>
        <a href="{{ route('portal.create') }}"
           class="bg-white text-blue-700 hover:bg-blue-100 font-semibold py-3 px-6 rounded-2xl shadow transition">
            Get Started
        </a>
    </section>
</x-guestLayout>
