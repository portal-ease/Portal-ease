<x-app-layout :portal="$portal">
    <div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-6">
        <div class="text-center space-y-3">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600">
                <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75 10 18.25 19.5 5.75" />
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-gray-800">Payment complete</h2>
            <p class="text-gray-600">The invoice has been marked as paid.</p>
        </div>

        <div class="rounded-2xl bg-green-50 border border-green-200 p-5 space-y-3 text-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                <div>
                    <p class="text-sm font-medium text-green-700">Invoice</p>
                    <h3 class="text-xl font-semibold text-gray-900 break-words">{{ $invoice->name }}</h3>
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

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('portal.invoice.show', ['portal' => $portal, 'invoice' => $invoice]) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-xl transition">
                View Invoice
            </a>

            <a href="{{ route('portal.invoice.download', ['portal' => $portal, 'invoice' => $invoice]) }}"
                class="bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-xl transition">
                Download Invoice
            </a>
        </div>
    </div>
</x-app-layout>
