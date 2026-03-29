<x-guestLayout>
    <!-- Hero Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-28 py-20 items-center bg-blue-50">
        <div class="flex flex-col gap-6 max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                Everything you need to manage clients in one place
            </h1>
            <p class="text-lg md:text-xl text-blue-800">
                Portalease brings together communication, file sharing, invoicing, and collaboration in a secure, branded portal your clients will love.
            </p>
            <a href="{{ route('portal.index') }}"
               class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl w-fit shadow-lg">
                Get Started
            </a>
        </div>
        <img src="{{ asset('features.png') }}" alt="Features illustration" class="w-1/2  rounded-xl shadow-xl">
    </section>

    <!-- Core Features -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 text-center mb-16">Powerful features for modern businesses</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="flex flex-col items-center text-center gap-4 p-6 rounded-xl shadow-lg hover:shadow-xl transition text-blue-700">
                <img src="{{ asset('document_sharing.png') }}" alt="document sharing icon" class="w-16 h-16">
                <h3 class="text-2xl font-bold text-blue-800">Document Sharing</h3>
                <p class="text-blue-700">Upload, organize, and securely share files with your clients. Keep everything in one place.</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4 p-6 rounded-xl shadow-lg hover:shadow-xl transition">
                <img src="{{ asset('messaging.png') }}" class="w-16 h-16" alt="Messaging feature">
                <h3 class="text-2xl font-bold text-blue-800">Messaging</h3>
                <p class="text-blue-700">Clear communication without endless email threads. Chat directly with your clients inside the portal.</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4 p-6 rounded-xl shadow-lg hover:shadow-xl transition">
                <img src="{{ asset('invoice.png') }}" class="w-16 h-16" alt="Invoicing feature">
                <h3 class="text-2xl font-bold text-blue-800">Invoicing</h3>
                <p class="text-blue-700">Send invoices directly to your clients and track payments, all within their portal.</p>
            </div>
        </div>
    </section>

    <!-- Extended Features -->
    <section class="bg-blue-50 py-20 px-6 md:px-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="flex flex-col gap-8">
                <h2 class="text-4xl font-extrabold text-blue-900">More than just a portal</h2>
                <ul class="space-y-4 text-blue-800 text-lg">
                    <li>🔹 Custom branding with your logo & colors</li>
                    <li>🔹 Invite unlimited team members</li>
                    <li>🔹 Real-time notifications</li>
                    <li>🔹 Organize multiple projects per client</li>
                    <li>🔹 Mobile-friendly experience for clients on the go</li>
                </ul>
                <a href="{{ route('portal.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl w-fit shadow">
                    Try it free
                </a>
            </div>
            <img src="{{ asset('collaboration.png') }}" alt="Collaboration illustration" class="w-full rounded-xl shadow-lg">
        </div>
    </section>

    <!-- Integration Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 text-center mb-12">Seamless integrations</h2>
        <p class="text-center text-blue-700 max-w-2xl mx-auto mb-16">
            Portalease works with the tools you already use, so you can keep your workflow smooth and efficient.
        </p>
        <div class="flex flex-wrap justify-center gap-12 items-center">
            <a href="https://stripe.com"><img src="{{ asset('stripe.png') }}" alt="Stripe" class="h-12"></a>
            <i class="text-blue-700 text-center">More coming soon!!!</i>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-4">Simplify your client work today</h2>
        <p class="text-lg md:text-xl mb-8">One platform for communication, collaboration, and client happiness.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('portal.index') }}"
               class="bg-white text-blue-700 hover:bg-blue-100 transition font-semibold py-3 px-6 rounded-2xl shadow">
                Get Started Free
            </a>
            <a href="{{ route('portal.index') }}"
               class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-700 font-semibold py-3 px-6 rounded-2xl transition">
                View demo
            </a>
        </div>
    </section>
</x-guestLayout>
