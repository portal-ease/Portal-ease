<x-guestLayout>
    <!-- Hero -->
    <section class="bg-gradient-to-br from-blue-700 to-blue-900 px-6 py-28 text-white">
        <div class="mx-auto grid max-w-6xl items-center gap-16 lg:grid-cols-2">
            <div>
                <span class="inline-block rounded-full bg-blue-500/30 px-4 py-2 text-sm font-semibold">
                    Everything in one workspace
                </span>

                <h1 class="mt-6 mb-6 text-5xl leading-tight font-extrabold md:text-6xl">
                    Powerful features built for client collaboration.
                </h1>

                <p class="mb-10 text-xl text-blue-100">
                    PortalEase helps you organize projects, communicate with clients, share files securely, and create a
                    professional experience—all from one intuitive dashboard.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a
                        href="{{ route('portal.create') }}"
                        class="rounded-2xl bg-white px-8 py-4 font-semibold text-blue-700 transition hover:bg-blue-100"
                    >
                        Create Your Portal
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=7NKmIakO1vw"
                        target="_blank"
                        class="rounded-2xl border border-white px-8 py-4 transition hover:bg-white hover:text-blue-700"
                    >
                        Watch Demo
                    </a>
                </div>
            </div>

            <div>
                <img src="{{ asset('creativeagency.jpg') }}" class="rounded-3xl shadow-2xl" alt="PortalEase Features" />
            </div>
        </div>
    </section>

    <section class="bg-white px-6 py-24">
        <div class="mx-auto max-w-7xl">
            <div class="mb-16 text-center">
                <h2 class="text-5xl font-bold text-blue-900">Everything you need</h2>

                <p class="mt-4 text-lg text-blue-700">Designed to simplify every interaction with your clients.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">📁</div>
                    <h3 class="mb-3 text-2xl font-bold">Document Management</h3>
                    <p>Upload, organize and securely share files.</p>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">💬</div>
                    <h3 class="mb-3 text-2xl font-bold">Messaging</h3>
                    <p>Communicate directly with clients without endless emails.</p>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">📊</div>
                    <h3 class="mb-3 text-2xl font-bold">Projects</h3>
                    <p>Manage project progress from one central dashboard.</p>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">👥</div>
                    <h3 class="mb-3 text-2xl font-bold">Client Management</h3>
                    <p>Invite clients and manage access with ease.</p>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">🎨</div>
                    <h3 class="mb-3 text-2xl font-bold">Custom Branding</h3>
                    <p>Use your own logo and colors for every portal.</p>
                </div>

                <div class="rounded-2xl bg-blue-50 p-8">
                    <div class="mb-4 text-4xl">🔒</div>
                    <h3 class="mb-3 text-2xl font-bold">Secure Access</h3>
                    <p>Keep client information protected in one secure environment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Extended Features -->
    <section class="bg-blue-50 px-6 py-20 md:px-28">
        <div class="grid grid-cols-1 items-center gap-16 md:grid-cols-2">
            <div class="flex flex-col gap-8">
                <h2 class="text-4xl font-extrabold text-blue-900">More than just a portal</h2>
                <ul class="space-y-4 text-lg text-blue-800">
                    <li>🔹 Custom branding with your logo & colors</li>
                    <li>🔹 Invite unlimited team members</li>
                    <li>🔹 Real-time notifications</li>
                    <li>🔹 Organize multiple projects per client</li>
                    <li>🔹 Mobile-friendly experience for clients on the go</li>
                </ul>
                <a
                    href="{{ route('portal.index') }}"
                    class="w-fit rounded-2xl bg-blue-600 px-6 py-3 font-semibold text-white shadow transition hover:bg-blue-700"
                >
                    Try it free
                </a>
            </div>
            <img
                src="{{ asset('collaboration.png') }}"
                alt="Collaboration illustration"
                class="w-full rounded-xl shadow-lg"
            />
        </div>
    </section>

    <section class="bg-blue-50 py-24">
        <div class="mx-auto max-w-5xl text-center">
            <h2 class="mb-12 text-4xl font-bold text-blue-900">Why businesses choose PortalEase</h2>

            <div class="grid gap-10 md:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow">
                    <h3 class="mb-6 text-2xl font-bold">Without PortalEase</h3>

                    <ul class="space-y-4 text-left">
                        <li>❌ Email attachments</li>
                        <li>❌ Multiple cloud storage services</li>
                        <li>❌ Scattered client communication</li>
                        <li>❌ Difficult project tracking</li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-blue-700 p-8 text-white shadow-xl">
                    <h3 class="mb-6 text-2xl font-bold">With PortalEase</h3>

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
        <h2 class="mb-6 text-5xl font-bold">Ready to transform your client experience?</h2>

        <p class="mx-auto mb-10 max-w-3xl text-xl text-blue-100">
            Everything your business needs to communicate, collaborate, and grow— all in one professional client portal.
        </p>

        <a
            href="{{ route('portal.create') }}"
            class="rounded-2xl bg-white px-8 py-4 font-semibold text-blue-700 transition hover:bg-blue-100"
        >
            Create Your Portal
        </a>
    </section>
</x-guestLayout>
