<x-app-layout :portal="currentPortal()">
    <div class="max-w-5xl mx-auto">
        <!-- New Invoice Button -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('portal.invoice.create', ['portal' => currentPortal()]) }}"
                class="text-sm bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl transition-all duration-200">
                + New Invoice
            </a>
        </div>

        <!-- Invoice List Container -->
        <div class="bg-white shadow-2xl rounded-2xl p-6 space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Invoices</h2>

            @forelse(currentPortal()->invoices as $invoice)
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-2xl
                            {{ $invoice->price == 0 ? 'bg-green-100' : 'bg-red-100' }}">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 text-gray-800">
                        <h3 class="font-semibold text-lg break-words">{{ $invoice->name }}</h3>
                        <span class="text-sm">
                            {{ $invoice->price == 0 ? 'Invoice is paid' : 'Invoice is not (yet) paid' }}
                        </span>
                    </div>

                    <a href="{{ route('portal.invoice.show', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                        class="mt-3 sm:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm transition">
                        View Invoice
                    </a>
                </div>
            @empty
                <p class="text-gray-600">There are currently no invoices created.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
