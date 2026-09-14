<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-5xl">
        <!-- New Invoice Button -->
        <div class="mb-4 flex justify-end">
            <a
                href="{{ route('portal.invoice.create', ['portal' => currentPortal()]) }}"
                class="rounded-xl bg-green-500 px-5 py-3 text-sm text-white transition-all duration-200 hover:bg-green-600"
            >
                + New Invoice
            </a>
        </div>

        <!-- Invoice List Container -->
        <div class="space-y-4 rounded-2xl bg-white p-6 shadow-2xl">
            <h2 class="text-2xl font-semibold text-gray-800">Invoices</h2>

            @forelse (currentPortal()->invoices as $invoice)
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-2xl
                            {{ $invoice->price == 0 ? 'bg-green-100' : 'bg-red-100' }}"
                >
                    <div class="flex flex-col gap-2 text-gray-800 sm:flex-row sm:items-center">
                        <h3 class="text-lg font-semibold break-words">{{ $invoice->name }}</h3>
                        <span class="text-sm">
                            {{ $invoice->price == 0 ? 'Invoice is paid' : 'Invoice is not (yet) paid' }}
                        </span>
                    </div>

                    <a
                        href="{{ route('portal.invoice.show', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                        class="mt-3 rounded-xl bg-blue-600 px-4 py-2 text-sm text-white transition hover:bg-blue-700 sm:mt-0"
                    >
                        View Invoice
                    </a>
                </div>
            @empty
                <p class="text-gray-600">There are currently no invoices created.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
