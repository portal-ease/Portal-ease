<x-guestLayout>
    <section class="bg-gradient-to-br from-blue-800 to-blue-950 px-6 py-20 text-white md:px-12">
        <div class="mx-auto max-w-6xl">
            <p class="mb-4 text-sm font-semibold tracking-widest text-blue-200 uppercase">PortalEase guide</p>
            <h1 class="max-w-3xl text-4xl font-extrabold md:text-6xl">
                Everything you need to run your client portal.
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-blue-100">
                Use this guide to set up your portal, invite people, and work with documents, projects, invoices, and
                conversations.
            </p>
            <nav class="mt-10 flex flex-wrap gap-3" aria-label="Documentation sections">
                @foreach (['start' => 'Get started', 'people' => 'People & access', 'documents' => 'Documents', 'projects' => 'Projects', 'invoices' => 'Invoices', 'messages' => 'Messages', 'settings' => 'Settings'] as $id => $label)
                    <a
                        href="#{{ $id }}"
                        class="rounded-full border border-white/30 px-4 py-2 text-sm font-medium transition hover:bg-white hover:text-blue-900"
                    >{{ $label }}</a>
                @endforeach
            </nav>
        </div>
    </section>

    <section class="bg-blue-50 px-6 py-10 md:px-12">
        <div class="mx-auto grid max-w-6xl gap-4 md:grid-cols-3">
            <div class="rounded-xl bg-white p-5 shadow-sm">
                <p class="font-semibold text-blue-900">Portal owner</p>
                <p class="mt-1 text-sm text-gray-600">Sets up branding, features, users, projects, and invoices.</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm">
                <p class="font-semibold text-blue-900">Manager or employee</p>
                <p class="mt-1 text-sm text-gray-600">Works on the enabled tools and can manage portal content.</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm">
                <p class="font-semibold text-blue-900">Client</p>
                <p class="mt-1 text-sm text-gray-600">
                    Views their shared work, documents, invoices, and conversations.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white px-6 py-16 md:px-12">
        <div class="mx-auto max-w-6xl space-y-16">
            <article id="start" class="scroll-mt-8">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">01 — Get started</p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Create and open your portal</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <ol class="space-y-4 rounded-2xl bg-blue-50 p-7 text-gray-700">
                        <li>
                            <span class="font-semibold text-blue-900">1. Create a portal.</span> Choose its name,
                            contact email, owner login, branding colour, and optional logo.
                        </li>
                        <li>
                            <span class="font-semibold text-blue-900">2. Verify your email.</span> Use the verification
                            link sent to the owner email before using the protected tools.
                        </li>
                        <li>
                            <span class="font-semibold text-blue-900">3. Sign in.</span> Open the portal URL and log in
                            with your account credentials.
                        </li>
                    </ol>
                    <div class="rounded-2xl border border-blue-100 p-7">
                        <h3 class="font-semibold text-blue-950">Your dashboard</h3>
                        <p class="mt-3 text-gray-700">
                            The dashboard is your home screen. It surfaces portal information and recent activity; the
                            left sidebar shows only the tools enabled for your portal and role.
                        </p>
                    </div>
                </div>
            </article>

            <article id="people" class="scroll-mt-8 border-t border-gray-200 pt-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">02 — People & access</p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Add users and keep profiles current</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div class="rounded-2xl bg-gray-50 p-7">
                        <h3 class="font-semibold text-blue-950">Add a user</h3>
                        <ol class="mt-4 list-inside list-decimal space-y-2 text-gray-700">
                            <li>Open <strong>Users</strong> in the sidebar.</li>
                            <li>Select the option to register a new user.</li>
                            <li>Enter their name, email, temporary password, and role.</li>
                            <li>Save the user, then share their portal link and credentials securely.</li>
                        </ol>
                    </div>
                    <div class="rounded-2xl bg-gray-50 p-7">
                        <h3 class="font-semibold text-blue-950">Roles at a glance</h3>
                        <ul class="mt-4 space-y-2 text-gray-700">
                            <li><strong>Service provider:</strong> portal owner; manages configuration and users.</li>
                            <li><strong>Manager / employee:</strong> works with enabled management tools.</li>
                            <li><strong>Client:</strong> sees only their own shared content and assigned items.</li>
                        </ul>
                        <p class="mt-4 text-sm text-gray-500">
                            Users can edit their profile details and upload a profile picture from their profile page.
                        </p>
                    </div>
                </div>
            </article>

            <article id="documents" class="scroll-mt-8 border-t border-gray-200 pt-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">03 — Documents</p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Share files with the right client</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div>
                        <ol class="list-inside list-decimal space-y-3 text-gray-700">
                            <li>Choose <strong>Share files/documents</strong>.</li>
                            <li>Give the document a clear name and select the file to upload.</li>
                            <li>Select the person who should receive it and choose its visibility.</li>
                            <li>
                                Share it. The recipient receives a notification and can find it under
                                <strong>Shared files/documents</strong>.
                            </li>
                        </ol>
                    </div>
                    <aside class="rounded-2xl bg-amber-50 p-6 text-amber-950">
                        <h3 class="font-semibold">Good practice</h3>
                        <p class="mt-2">
                            Use descriptive names such as “Signed contract — October 2026.” Only share files with the
                            intended recipient, and use the download action from the document page when a copy is
                            needed.
                        </p>
                    </aside>
                </div>
            </article>

            <article id="projects" class="scroll-mt-8 border-t border-gray-200 pt-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">04 — Projects</p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Track client work in one place</h2>
                <ol class="mt-6 grid gap-4 text-gray-700 md:grid-cols-4">
                    <li class="rounded-xl bg-blue-50 p-5">
                        <strong>1. Create</strong><br />Open Projects and start a new project.
                    </li>
                    <li class="rounded-xl bg-blue-50 p-5">
                        <strong>2. Assign</strong><br />Name it, choose the customer, and set start and end dates.
                    </li>
                    <li class="rounded-xl bg-blue-50 p-5">
                        <strong>3. Review</strong><br />Open a project to view its details and related invoices.
                    </li>
                    <li class="rounded-xl bg-blue-50 p-5">
                        <strong>4. Client view</strong><br />Clients see only projects assigned to them.
                    </li>
                </ol>
            </article>

            <article id="invoices" class="scroll-mt-8 border-t border-gray-200 pt-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">05 — Invoices</p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Create, send, and record invoice payment</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <ol class="list-inside list-decimal space-y-3 text-gray-700">
                        <li>Open <strong>Invoices</strong> and create a new invoice.</li>
                        <li>
                            Add its name, invoice file, description, expiry date, payment amount, customer, and optional
                            project.
                        </li>
                        <li>Save it. The invoice file is shared with the selected customer.</li>
                        <li>
                            The customer can open and download their invoice, then use the payment action when it has
                            been paid.
                        </li>
                    </ol>
                    <div class="rounded-2xl bg-blue-950 p-6 text-white">
                        <h3 class="font-semibold">Payment status</h3>
                        <p class="mt-2 text-blue-100">
                            Once payment is confirmed through the portal, the invoice is marked paid and the
                            payment-complete screen is shown. Keep the attached invoice file as the source document for
                            your records.
                        </p>
                    </div>
                </div>
            </article>

            <article id="messages" class="scroll-mt-8 border-t border-gray-200 pt-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">
                    06 — Conversations & notifications
                </p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Keep communication in the portal</h2>
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div class="rounded-2xl bg-gray-50 p-7">
                        <h3 class="font-semibold text-blue-950">Conversations</h3>
                        <p class="mt-3 text-gray-700">
                            Open <strong>Conversations</strong> from the sidebar, choose a conversation, and send
                            messages there so client communication stays connected to the portal.
                        </p>
                    </div>
                    <div class="rounded-2xl bg-gray-50 p-7">
                        <h3 class="font-semibold text-blue-950">Notifications</h3>
                        <p class="mt-3 text-gray-700">
                            Use the bell in the top bar to review notifications, including alerts when a document is
                            shared with you.
                        </p>
                    </div>
                </div>
            </article>

            <article id="settings" class="scroll-mt-8 border-t border-gray-200 pt-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase">07 — Portal settings</p>
                <h2 class="mt-2 text-3xl font-bold text-blue-950">Make the portal yours</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <div class="rounded-xl border p-5">
                        <h3 class="font-semibold text-blue-950">General</h3>
                        <p class="mt-2 text-sm text-gray-700">
                            Change the portal name and contact email from the settings icon.
                        </p>
                    </div>
                    <div class="rounded-xl border p-5">
                        <h3 class="font-semibold text-blue-950">Branding & logo</h3>
                        <p class="mt-2 text-sm text-gray-700">
                            Set your branding colour and upload a PNG, JPG, or JPEG logo.
                        </p>
                    </div>
                    <div class="rounded-xl border p-5">
                        <h3 class="font-semibold text-blue-950">Feature controls</h3>
                        <p class="mt-2 text-sm text-gray-700">
                            Enable or disable Documents, Projects, Invoices, and Conversations. Disabled tools are
                            hidden from users.
                        </p>
                    </div>
                </div>
                <p class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-900">
                    <strong>Note:</strong> Deleting a portal is permanent. Review the danger-zone warning carefully
                    before confirming it.
                </p>
            </article>

            <section class="rounded-2xl bg-blue-600 p-8 text-center text-white">
                <h2 class="text-2xl font-bold">Need more help?</h2>
                <p class="mt-2 text-blue-100">
                    Contact the PortalEase team and include the portal name and a short description of what you need.
                </p>
                <a
                    href="{{ route('support') }}"
                    class="mt-5 inline-block rounded-xl bg-white px-5 py-3 font-semibold text-blue-700 transition hover:bg-blue-100"
                >Contact support</a>
            </section>
        </div>
    </section>
</x-guestLayout>
