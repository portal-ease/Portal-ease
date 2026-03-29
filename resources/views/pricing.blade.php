<x-guestLayout>
    <!-- Hero Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-28 py-20 items-center bg-blue-50">
        <div class="flex flex-col gap-6 max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                Choose a Plan That Fits Your Business
            </h1>
            <p class="text-lg md:text-xl text-blue-800">
                Simple, transparent pricing with plans for freelancers, small teams, and growing agencies.
            </p>
            <a href="#plans"
               class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl w-fit shadow-lg">
                View Plans
            </a>
        </div>
        <img src="{{ asset('subscription.png') }}" alt="Pricing illustration" class="w-full rounded-xl shadow-xl">
    </section>

    <!-- Pricing Plans Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 text-center mb-12">
            Flexible Plans for Every Business
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

            <!-- Free Trial Plan -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center text-center border border-transparent hover:border-blue-600 hover:shadow-xl transition cursor-pointer">
                <h3 class="text-2xl font-bold text-blue-800 mb-2">Free Trial</h3>
                <p class="text-blue-700 text-lg mb-6">Explore Portalease risk-free for 14 days.</p>
                <span class="text-4xl font-extrabold text-blue-900 mb-6">Free</span>

                <ul class="text-blue-800 mb-8 space-y-2 text-left w-full">
                    <li>🔹 Up to 3 Clients</li>
                    <li>🔹 Document Sharing</li>
                    <li>🔹 1 Project</li>
                </ul>

                <a href="{{ route('portal.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl shadow w-full text-center">
                    Start Free
                </a>
            </div>

            <!-- Premium Plan -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center text-center border-2 border-yellow-600 shadow-xl relative">
                <!-- Badge -->
                <span
                    class="absolute top-0 right-0 bg-yellow-600 text-white text-sm font-bold px-4 py-1 rounded-bl-2xl rounded-tr-2xl">
                Most Popular
            </span>

                <h3 class="text-2xl font-bold text-yellow-800 mb-2">Premium</h3>
                <p class="text-yellow-700 text-lg mb-6">Best for freelancers and small teams ready to grow.</p>
                <span class="text-4xl font-extrabold text-yellow-900 mb-6">$19<span
                        class="text-lg font-normal">/month</span></span>

                <ul class="text-yellow-800 mb-8 space-y-2 text-left w-full">
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <polygon points="10,2 18,10 10,18 2,10"/>
                        </svg>
                        All benefits from the free plan
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <polygon points="10,2 18,10 10,18 2,10"/>
                        </svg>
                        Invoices & Payments
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <polygon points="10,2 18,10 10,18 2,10"/>
                        </svg>
                        Team Chats & Collaboration
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <polygon points="10,2 18,10 10,18 2,10"/>
                        </svg>
                        Notifications
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <polygon points="10,2 18,10 10,18 2,10"/>
                        </svg>
                        Custom Branding & Logo
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <polygon points="10,2 18,10 10,18 2,10"/>
                        </svg>
                        Unlimited Clients & Projects
                    </li>
                </ul>
                <a href="{{ route('portal.index') }}"
                   class="bg-yellow-600 hover:bg-yellow-700 transition text-white font-semibold py-3 px-6 rounded-2xl shadow w-full text-center">
                    Get Started
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-4">Ready to start your client portal?</h2>
        <p class="text-lg md:text-xl mb-8">Choose the plan that fits your needs and get started today.</p>
        <a href="{{ route('portal.index') }}"
           class="bg-white text-blue-700 hover:bg-blue-100 transition font-semibold py-3 px-6 rounded-2xl shadow">
            Get Started
        </a>
    </section>
</x-guestLayout>
