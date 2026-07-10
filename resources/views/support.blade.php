<x-guestLayout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-700 to-blue-900 text-white py-28 px-6">

        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

            <div>
            <span class="bg-blue-500/30 text-blue-100 px-4 py-2 rounded-full text-sm font-semibold">
                PortalEase Support
            </span>

                <h1 class="text-5xl font-extrabold mt-6 mb-6">
                    How can we help you today?
                </h1>

                <p class="text-xl text-blue-100 mb-8">
                    Whether you're setting up your portal, inviting clients, or troubleshooting an issue,
                    our team is ready to help.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#contact-form"
                       class="bg-white text-blue-700 hover:bg-blue-100 px-6 py-3 rounded-2xl font-semibold transition">
                        Contact Support
                    </a>

                    <a href="https://www.youtube.com/watch?v=7NKmIakO1vw"
                       target="_blank"
                       class="border border-white px-6 py-3 rounded-2xl hover:bg-white hover:text-blue-700 transition">
                        Watch Tutorials
                    </a>
                </div>
            </div>

            <div>
                <img src="{{ asset('support.png') }}"
                     class="rounded-3xl shadow-2xl"
                     alt="Support">
            </div>

        </div>

    </section>

    <section class="bg-white py-20 px-6 md:px-28">

        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-blue-900">
                Quick Help
            </h2>
            <p class="text-blue-700 mt-3">
                Find the help you need in just a few clicks.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-blue-50 rounded-2xl p-8 shadow">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="font-bold text-xl mb-3 text-blue-900">
                    Documentation
                </h3>

                <p class="text-blue-700">
                    Learn how every PortalEase feature works with detailed guides.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 shadow">
                <div class="text-4xl mb-4">🎥</div>
                <h3 class="font-bold text-xl mb-3 text-blue-900">
                    Video Tutorials
                </h3>

                <p class="text-blue-700">
                    Watch short videos explaining setup and daily usage.
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 shadow">
                <div class="text-4xl mb-4">💬</div>
                <h3 class="font-bold text-xl mb-3 text-blue-900">
                    Contact Us
                </h3>

                <p class="text-blue-700">
                    Can't find your answer? Send us a message and we'll help you.
                </p>
            </div>

        </div>

    </section>

    <!-- FAQ Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 mb-12 text-center">Frequently Asked Questions</h2>
        <div class="space-y-6 max-w-4xl mx-auto">
            <div class="bg-blue-50 rounded-xl p-6 shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-800 mb-2">How do I create a client portal?</h3>
                <p class="text-blue-800 text-lg">Simply click on "Try for free" and follow the step-by-step instructions to set up your personalized portal in minutes.</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-6 shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-800 mb-2">Can I share documents securely?</h3>
                <p class="text-blue-800 text-lg">Yes, Portalease ensures that all documents, invoices, and messages are securely shared with your clients.</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-6 shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-800 mb-2">Is there a mobile app?</h3>
                <p class="text-blue-800 text-lg">Currently, Portalease is fully accessible via any web browser on mobile devices for convenience on the go.</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-6 shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-800 mb-2">How do I invite clients?</h3>
                <p class="text-blue-800 text-lg">Open your portal dashboard, go to Clients and send an invitation by email. Your client will receive a secure link to access their portal.</p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact-form" class="bg-blue-50 py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 text-center mb-12">Contact Us</h2>
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <form action="/" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-blue-800 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full border border-blue-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div>
                    <label for="email" class="block text-blue-800 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full border border-blue-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div>
                    <label for="message" class="block text-blue-800 font-semibold mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full border border-blue-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                </div>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl shadow w-full">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-4">Still have questions?</h2>
        <p class="text-lg md:text-xl mb-8">Our team is here to help you get the most out of your client portal.</p>
        <a href="#contact-form"
           class="bg-white text-blue-700 hover:bg-blue-100 transition font-semibold py-3 px-6 rounded-2xl shadow">
            Contact Support
        </a>
    </section>
</x-guestLayout>
