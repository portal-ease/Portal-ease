<x-guestLayout>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white py-28 px-6">

        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <span class="inline-block px-4 py-2 rounded-full bg-blue-500/30 text-sm font-semibold">
                    Everything in one workspace
                </span>

                <h1 class="text-5xl md:text-6xl font-extrabold mt-6 mb-6 leading-tight">
                    Powerful features built for client collaboration.
                </h1>

                <p class="text-xl text-blue-100 mb-10">
                    PortalEase helps you organize projects, communicate with clients,
                    share files securely, and create a professional experience—all from
                    one intuitive dashboard.
                </p>

                <div class="flex gap-4 flex-wrap">

                    <a href="{{ route('portal.create') }}"
                        class="bg-white text-blue-700 px-8 py-4 rounded-2xl font-semibold hover:bg-blue-100 transition">
                        Create Your Portal
                    </a>

                    <a href="https://www.youtube.com/watch?v=7NKmIakO1vw" target="_blank"
                        class="border border-white px-8 py-4 rounded-2xl hover:bg-white hover:text-blue-700 transition">
                        Watch Demo
                    </a>

                </div>

            </div>

            <div>
                <img src="{{ asset('creativeagency.jpg') }}" class="rounded-3xl shadow-2xl" alt="PortalEase Features">
            </div>

        </div>

    </section>

    <section class="bg-white py-24 px-6">

        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16">

                <h2 class="text-5xl font-bold text-blue-900">
                    Everything you need
                </h2>

                <p class="text-blue-700 mt-4 text-lg">
                    Designed to simplify every interaction with your clients.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="text-4xl mb-4">📁</div>
                    <h3 class="font-bold text-2xl mb-3">Document Management</h3>
                    <p>Upload, organize and securely share files.</p>
                </div>

                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="font-bold text-2xl mb-3">Messaging</h3>
                    <p>Communicate directly with clients without endless emails.</p>
                </div>

                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="font-bold text-2xl mb-3">Projects</h3>
                    <p>Manage project progress from one central dashboard.</p>
                </div>

                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="text-4xl mb-4">👥</div>
                    <h3 class="font-bold text-2xl mb-3">Client Management</h3>
                    <p>Invite clients and manage access with ease.</p>
                </div>

                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="font-bold text-2xl mb-3">Custom Branding</h3>
                    <p>Use your own logo and colors for every portal.</p>
                </div>

                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="text-4xl mb-4">🔒</div>
                    <h3 class="font-bold text-2xl mb-3">Secure Access</h3>
                    <p>Keep client information protected in one secure environment.</p>
                </div>

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
            <img src="{{ asset('collaboration.png') }}" alt="Collaboration illustration"
                class="w-full rounded-xl shadow-lg">
        </div>
    </section>

    <section class="bg-blue-50 py-24">

        <div class="max-w-5xl mx-auto text-center">

            <h2 class="text-4xl font-bold text-blue-900 mb-12">
                Why businesses choose PortalEase
            </h2>

            <div class="grid md:grid-cols-2 gap-10">

                <div class="bg-white rounded-2xl p-8 shadow">

                    <h3 class="font-bold text-2xl mb-6">
                        Without PortalEase
                    </h3>

                    <ul class="space-y-4 text-left">
                        <li>❌ Email attachments</li>
                        <li>❌ Multiple cloud storage services</li>
                        <li>❌ Scattered client communication</li>
                        <li>❌ Difficult project tracking</li>
                    </ul>

                </div>

                <div class="bg-blue-700 text-white rounded-2xl p-8 shadow-xl">

                    <h3 class="font-bold text-2xl mb-6">
                        With PortalEase
                    </h3>

                    <ul class="space-y-4 text-left">
                        <li>✅ Secure client portal</li>
                        <li>✅ Centralized communication</li>
                        <li>✅ Organized projects</li>
                        <li>✅ Professional client experience</li>
                    </ul>

                </div>

            </div>

        </div>

    </section>

    <!-- Call to Action -->
    <section class="bg-blue-700 py-24 text-center text-white">

        <h2 class="text-5xl font-bold mb-6">
            Ready to transform your client experience?
        </h2>

        <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-10">
            Everything your business needs to communicate, collaborate, and grow—
            all in one professional client portal.
        </p>

        <a href="{{ route('portal.create') }}"
            class="bg-white text-blue-700 px-8 py-4 rounded-2xl font-semibold hover:bg-blue-100 transition">
            Create Your Portal
        </a>

    </section>
</x-guestLayout>
