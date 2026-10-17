@php
    $activeTab = request()->query('tab', 'overview');

    $allowedTabs = [
        'overview',
        'payments',
        'invoices',
    ];

    if (
        ! in_array($activeTab, $allowedTabs, true)
        || (
            in_array($activeTab, ['payments', 'invoices'], true)
            && ! $invoicesEnabled
        )
    ) {
        $activeTab = 'overview';
    }

    $statusClasses = match ($project->status) {
        'finished', 'completed' =>
            'bg-green-100 text-green-700',
        'in_progress', 'in progress' =>
            'bg-blue-100 text-blue-700',
        'in_review', 'in review' =>
            'bg-amber-100 text-amber-700',
        default =>
            'bg-gray-100 text-gray-700',
    };
@endphp

<x-app-layout :portal="$portal">
    <div class="mx-auto max-w-7xl space-y-6">
        {{-- Project header --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div class="min-w-0">
                    <div class="mb-3 flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                            {{ str_replace('_', ' ', ucfirst($project->status)) }}
                        </span>

                        @if ($project->end_date)
                            <span class="flex items-center gap-1.5 text-sm text-gray-500">
                                <x-lucide-calendar class="h-4 w-4" />
                                Due {{ \Illuminate\Support\Carbon::parse($project->end_date)->format('d M Y') }}
                            </span>
                        @endif
                    </div>

                    <h1 class="break-words text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        {{ $project->name }}
                    </h1>

                    @if ($canManageProject && $project->customer)
                        <p class="mt-2 flex items-center gap-2 text-sm text-gray-500">
                            <x-lucide-user class="h-4 w-4" />
                            {{ $project->customer->name }}
                        </p>
                    @endif
                </div>

                {{-- Project actions --}}
                <div class="flex flex-wrap items-center gap-2">
                    {{-- Connect this to your existing edit route if available. --}}

                    @if ($canManageProject)
                        <form
                            method="POST"
                            action="{{ route('portal.project.destroy', [
                                'project' => $project,
                                'portal' => $portal,
                            ]) }}"
                            onsubmit="return confirm('Are you sure you want to delete this project?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-lg border border-red-200 px-4 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50"
                            >
                                <x-lucide-trash class="h-4 w-4" />
                                Delete project
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </section>

        {{-- Project navigation --}}
        <nav
            class="overflow-x-auto rounded-xl border border-gray-200 bg-white"
            aria-label="Project navigation"
        >
            <div class="flex min-w-max gap-1 p-2">
                @php
                    $tabs = [
                        'overview' => 'Overview',
                        'payments' => 'Payments',
                        'invoices' => 'Invoices',
                    ];
                @endphp

                @foreach ($tabs as $key => $label)
                    @if (
                        ! in_array($key, ['payments', 'invoices'], true)
                        || $invoicesEnabled
                    )
                        <a
                            href="{{ request()->fullUrlWithQuery(['tab' => $key]) }}"
                            @if ($activeTab === $key) aria-current="page" @endif
                            class="rounded-lg px-4 py-2.5 text-sm font-medium transition
                                {{ $activeTab === $key
                                    ? 'bg-green-50 text-green-700'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}"
                        >
                            {{ $label }}

                            @if ($key === 'invoices' && $projectInvoices->isNotEmpty())
                                <span class="ml-1.5 rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">
                                    {{ $projectInvoices->count() }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
        </nav>

        {{-- Tab content --}}
        @if ($activeTab === 'overview')

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Main overview --}}
                <div class="space-y-6 lg:col-span-2">

                    <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="mb-5">
                            <h2 class="text-lg font-semibold text-gray-900">
                                Project overview
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Key information about this project.
                            </p>
                        </div>

                        <dl class="divide-y divide-gray-100">
                            <div class="flex flex-col gap-1 py-4 sm:flex-row sm:justify-between sm:gap-4">
                                <dt class="text-sm text-gray-500">Project name</dt>
                                <dd class="break-words text-sm font-medium text-gray-900 sm:text-right">
                                    {{ $project->name }}
                                </dd>
                            </div>

                            <div class="flex flex-col gap-1 py-4 sm:flex-row sm:justify-between sm:gap-4">
                                <dt class="text-sm text-gray-500">Status</dt>
                                <dd class="text-sm font-medium text-gray-900 sm:text-right">
                                    {{ str_replace('_', ' ', ucfirst($project->status)) }}
                                </dd>
                            </div>

                            <div class="flex flex-col gap-1 py-4 sm:flex-row sm:justify-between sm:gap-4">
                                <dt class="text-sm text-gray-500">Deadline</dt>
                                <dd class="text-sm font-medium text-gray-900 sm:text-right">
                                    {{ $project->end_date
                                        ? \Illuminate\Support\Carbon::parse($project->end_date)->format('d F Y')
                                        : 'No deadline set' }}
                                </dd>
                            </div>

                            @if ($canManageProject && $project->customer)
                                <div class="flex flex-col gap-1 py-4 sm:flex-row sm:justify-between sm:gap-4">
                                    <dt class="text-sm text-gray-500">Customer</dt>
                                    <dd class="text-sm font-medium text-gray-900 sm:text-right">
                                        {{ $project->customer->name }}
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </section>

                    {{-- Recent invoices --}}
                    @if ($invoicesEnabled)
                        <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                            <div class="mb-5 flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">
                                        Recent invoices
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Invoices associated with this project.
                                    </p>
                                </div>

                                <a
                                    href="{{ request()->fullUrlWithQuery(['tab' => 'invoices']) }}"
                                    class="shrink-0 text-sm font-medium text-green-700 hover:text-green-800"
                                >
                                    View all
                                </a>
                            </div>

                            @forelse ($projectInvoices->take(3) as $invoice)
                                <a
                                    href="{{ route('portal.invoice.show', [
                                        'portal' => $portal,
                                        'invoice' => $invoice,
                                    ]) }}"
                                    class="flex items-center justify-between gap-4 rounded-xl border border-gray-100 p-4 transition hover:border-gray-200 hover:bg-gray-50"
                                >
                                    <div class="flex min-w-0 items-center gap-3">
                                        <div class="rounded-lg bg-green-50 p-2.5 text-green-700">
                                            <x-lucide-file-text class="h-5 w-5" />
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-medium text-gray-900">
                                                {{ $invoice->name }}
                                            </p>
                                            <p class="mt-1 text-xs text-gray-500">
                                                View invoice
                                            </p>
                                        </div>
                                    </div>

                                    <span class="shrink-0 text-sm font-semibold text-gray-900">
                                        ${{ number_format((float) $invoice->price, 2) }}
                                    </span>
                                </a>
                            @empty
                                <div class="rounded-xl border border-dashed border-gray-200 px-4 py-8 text-center">
                                    <x-lucide-file-text class="mx-auto h-8 w-8 text-gray-400" />
                                    <p class="mt-2 text-sm font-medium text-gray-700">
                                        No invoices yet
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Invoices for this project will appear here.
                                    </p>
                                </div>
                            @endforelse
                        </section>
                    @endif
                </div>

                {{-- Right sidebar --}}
                <aside class="space-y-6">

                    <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Financial overview
                        </h2>

                        @if ($invoicesEnabled)
                            <p class="mt-4 text-sm text-gray-500">
                                Total invoiced
                            </p>

                            <p class="mt-1 text-3xl font-bold tracking-tight text-gray-900">
                                ${{ number_format((float) $projectInvoices->sum('price'), 2) }}
                            </p>

                            <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4">
                                <span class="text-sm text-gray-500">
                                    Invoices
                                </span>
                                <span class="text-sm font-semibold text-gray-900">
                                    {{ $projectInvoices->count() }}
                                </span>
                            </div>

                            <a
                                href="{{ request()->fullUrlWithQuery(['tab' => 'payments']) }}"
                                class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                            >
                                View payments
                                <x-lucide-arrow-right class="h-4 w-4" />
                            </a>
                        @else
                            <p class="mt-2 text-sm text-gray-500">
                                Financial information is not enabled for this portal.
                            </p>
                        @endif
                    </section>

                    <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Project actions
                        </h2>

                        <h2 class="mt-2 text-sm text-gray-500">Coming soon...</h2>
                    </section>
                </aside>
            </div>

        @elseif ($activeTab === 'payments')

            <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-900">Payments</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Financial summary for this project.
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl bg-gray-50 p-5">
                        <p class="text-sm text-gray-500">Total invoiced</p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            ${{ number_format((float) $projectInvoices->sum('price'), 2) }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-5">
                        <p class="text-sm text-gray-500">Invoices issued</p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            {{ $projectInvoices->count() }}
                        </p>
                    </div>
                </div>

                <p class="mt-5 text-sm text-gray-500">
                    These figures represent invoice totals, not confirmed payments.
                    Payment status can be displayed here when payment records are available.
                </p>
            </section>

        @elseif ($activeTab === 'invoices')

            <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Invoices</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        All invoices associated with this project.
                    </p>
                </div>

                @forelse ($projectInvoices as $invoice)
                    <a
                        href="{{ route('portal.invoice.show', [
                            'portal' => $portal,
                            'invoice' => $invoice,
                        ]) }}"
                        class="flex items-center justify-between gap-4 border-b border-gray-100 py-4 last:border-0"
                    >
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="rounded-lg bg-green-50 p-3 text-green-700">
                                <x-lucide-list-checks class="h-5 w-5" />
                            </div>
                            <span class="truncate text-sm font-medium text-gray-900">
                                {{ $invoice->name }}
                            </span>
                        </div>

                        <div class="flex shrink-0 items-center gap-3">
                            <span class="text-sm font-semibold text-gray-900">
                                ${{ number_format((float) $invoice->price, 2) }}
                            </span>
                            <x-lucide-chevron-right class="h-4 w-4 text-gray-400" />
                        </div>
                    </a>
                @empty
                    <p class="py-8 text-center text-sm text-gray-500">
                        No invoices have been created for this project.
                    </p>
                @endforelse
            </section>
        @endif

    </div>
</x-app-layout>
