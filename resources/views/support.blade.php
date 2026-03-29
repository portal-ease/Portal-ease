<x-guestLayout>
    <!-- Hero Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-28 py-20 items-center bg-blue-50">
        <div class="flex flex-col gap-6 max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                Need help? We're here for you.
            </h1>
            <p class="text-lg md:text-xl text-blue-800">
                Our support team is ready to help you with any questions or issues. Get assistance quickly and easily.
            </p>
            <a href="#contact-form"
               class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl w-fit shadow-lg">
                Contact Support
            </a>
        </div>
        <img src="{{ asset('support.png') }}" alt="Illustration of support" class="w-full rounded-xl shadow-xl">
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
                <h3 class="text-2xl font-semibold text-blue-800 mb-2">How do I upgrade my plan?</h3>
                <p class="text-blue-800 text-lg">You can upgrade your subscription anytime from your portal dashboard under "Billing & Plans".</p>
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
