<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-3xl space-y-6 rounded-2xl bg-white p-8 shadow-2xl">
        <div class="space-y-3 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600">
                <svg
                    class="h-9 w-9"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75 10 18.25 19.5 5.75" />
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-gray-800">Payment complete</h2>
            <p class="text-gray-600">The invoice has been marked as paid.</p>
        </div>

        <div class="space-y-3 rounded-2xl border border-green-200 bg-green-50 p-5 text-gray-700">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-green-700">Invoice</p>
                    <h3 class="text-xl font-semibold break-words text-gray-900">{{ $invoice->name }}</h3>
                </div>
            </div>

            @if ($invoice->description)
                <p><span class="font-semibold">Description:</span> {{ $invoice->description }}</p>
            @endif

            @if ($invoice->expiry_date)
                <p><span class="font-semibold">Expiry date:</span> {{ $invoice->expiry_date }}</p>
            @endif

            <p><span class="font-semibold">Amount due:</span> ${{ number_format($invoice->price, 2) }}</p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <a
                href="{{ route('portal.invoice.show', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                class="rounded-xl bg-blue-600 py-3 text-center text-white transition hover:bg-blue-700"
            >
                View Invoice
            </a>

            <a
                href="{{ route('portal.invoice.download', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                class="rounded-xl bg-green-500 py-3 text-center text-white transition hover:bg-green-600"
            >
                Download Invoice
            </a>
        </div>
    </div>
</x-app-layout>
