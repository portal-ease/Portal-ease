<x-guestLayout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-700 to-blue-900 px-6 py-28 text-white">
        <div class="mx-auto grid max-w-6xl items-center gap-12 lg:grid-cols-2">
            <div>
                <span class="rounded-full bg-blue-500/30 px-4 py-2 text-sm font-semibold text-blue-100">
                    PortalEase Support
                </span>

                <h1 class="mt-6 mb-6 text-5xl font-extrabold">How can we help you today?</h1>

                <p class="mb-8 text-xl text-blue-100">
                    Whether you're setting up your portal, inviting clients, or troubleshooting an issue, our team is
                    ready to help.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a
                        href="#contact-form"
                        class="rounded-2xl bg-white px-6 py-3 font-semibold text-blue-700 transition hover:bg-blue-100"
                    >
                        Contact Support
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=7NKmIakO1vw"
                        target="_blank"
                        class="rounded-2xl border border-white px-6 py-3 transition hover:bg-white hover:text-blue-700"
                    >
                        Watch Tutorials
                    </a>
                </div>
            </div>

            <div>
                <img src="{{ asset('support.png') }}" class="rounded-3xl shadow-2xl" alt="Support" />
            </div>
        </div>
    </section>

    <section class="bg-white px-6 py-20 md:px-28">
        <div class="mb-14 text-center">
            <h2 class="text-4xl font-bold text-blue-900">Quick Help</h2>
            <p class="mt-3 text-blue-700">Find the help you need in just a few clicks.</p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <div class="rounded-2xl bg-blue-50 p-8 shadow">
                <div class="mb-4 text-4xl">📚</div>
                <h3 class="mb-3 text-xl font-bold text-blue-900">Documentation</h3>

                <p class="text-blue-700">Learn how every PortalEase feature works with detailed guides.</p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-8 shadow">
                <div class="mb-4 text-4xl">🎥</div>
                <h3 class="mb-3 text-xl font-bold text-blue-900">Video Tutorials</h3>

                <p class="text-blue-700">Watch short videos explaining setup and daily usage.</p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-8 shadow">
                <div class="mb-4 text-4xl">💬</div>
                <h3 class="mb-3 text-xl font-bold text-blue-900">Contact Us</h3>

                <p class="text-blue-700">Can't find your answer? Send us a message and we'll help you.</p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-white px-6 py-20 md:px-28">
        <h2 class="mb-12 text-center text-4xl font-extrabold text-blue-900">Frequently Asked Questions</h2>
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="rounded-xl bg-blue-50 p-6 shadow-lg">
                <h3 class="mb-2 text-2xl font-semibold text-blue-800">How do I create a client portal?</h3>
                <p class="text-lg text-blue-800">
                    Simply click on "Try for free" and follow the step-by-step instructions to set up your personalized
                    portal in minutes.
                </p>
            </div>
            <div class="rounded-xl bg-blue-50 p-6 shadow-lg">
                <h3 class="mb-2 text-2xl font-semibold text-blue-800">Can I share documents securely?</h3>
                <p class="text-lg text-blue-800">
                    Yes, Portalease ensures that all documents, invoices, and messages are securely shared with your
                    clients.
                </p>
            </div>
            <div class="rounded-xl bg-blue-50 p-6 shadow-lg">
                <h3 class="mb-2 text-2xl font-semibold text-blue-800">Is there a mobile app?</h3>
                <p class="text-lg text-blue-800">
                    Currently, Portalease is fully accessible via any web browser on mobile devices for convenience on
                    the go.
                </p>
            </div>
            <div class="rounded-xl bg-blue-50 p-6 shadow-lg">
                <h3 class="mb-2 text-2xl font-semibold text-blue-800">How do I invite clients?</h3>
                <p class="text-lg text-blue-800">
                    Open your portal dashboard, go to Clients and send an invitation by email. Your client will receive
                    a secure link to access their portal.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact-form" class="bg-blue-50 px-6 py-20 md:px-28">
        <h2 class="mb-12 text-center text-4xl font-extrabold text-blue-900">Contact Us</h2>
        <div class="mx-auto max-w-3xl rounded-xl bg-white p-8 shadow-lg">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('website.contact') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="mb-2 block font-semibold text-blue-800">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="w-full rounded-xl border border-blue-300 px-4 py-3 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                    />
                </div>
                <div>
                    <label for="email" class="mb-2 block font-semibold text-blue-800">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="w-full rounded-xl border border-blue-300 px-4 py-3 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                    />
                </div>
                <div>
                    <label for="message" class="mb-2 block font-semibold text-blue-800">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        required
                        class="w-full rounded-xl border border-blue-300 px-4 py-3 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                    ></textarea>
                </div>
                <button
                    type="submit"
                    class="w-full rounded-2xl bg-blue-600 px-6 py-3 font-semibold text-white shadow transition hover:bg-blue-700"
                >
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 px-6 py-20 text-center text-white md:px-28">
        <h2 class="mb-4 text-4xl font-extrabold">Still have questions?</h2>
        <p class="mb-8 text-lg md:text-xl">Our team is here to help you get the most out of your client portal.</p>
        <a
            href="#contact-form"
            class="rounded-2xl bg-white px-6 py-3 font-semibold text-blue-700 shadow transition hover:bg-blue-100"
        >
            Contact Support
        </a>
    </section>
</x-guestLayout>
