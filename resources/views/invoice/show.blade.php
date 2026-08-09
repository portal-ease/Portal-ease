<x-app-layout :portal="$portal">
    <div class="bg-white shadow-2xl rounded-2xl p-8 space-y-6 max-w-4xl mx-auto">
        <!-- Invoice Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">{{ $invoice->name }}</h2>
        </div>

        <!-- Invoice Info -->
        <div class="space-y-2 text-gray-700">
            <p><span class="font-semibold">Name:</span> {{ $invoice->name }}</p>
            <p><span class="font-semibold">Description:</span> {{ $invoice->description }}</p>
            <p><span class="font-semibold">Expiry Date:</span> {{ $invoice->expiry_date }}</p>
            @if ($invoice->price != 0)
                <p><span class="font-semibold">Payment:</span> ${{ $invoice->price }}</p>
            @endif
        </div>

        <!-- Payment Button for Clients -->
        @if ($user->hasRole('client') && $invoice->price != 0)
            <div class="flex flex-row gap-5">
                <form action="{{ route('portal.invoice.payment', ['portal' => $portal, 'invoice' => $invoice]) }}"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl w-full sm:w-auto">
                        Pay Invoice
                    </button>
                </form>
                <a href="{{ route('portal.invoice.download', ['portal' => $portal, 'invoice' => $invoice]) }}"
                    class="bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl">
                    Download Invoice
                </a>
            </div>
        @endif

        <!-- Paid Notice + Delete (if paid) -->
        @if ($invoice->price == 0)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-green-100 p-4 rounded-xl">
                <p class="text-xl font-semibold text-green-700">This invoice is paid</p>
                @if ($user->hasRole('service_provider'))
                    <form action="{{ route('portal.invoice.destroy', ['portal' => $portal, 'invoice' => $invoice]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl cursor-pointer">
                            Delete Invoice
                        </button>
                    </form>
                @endif
            </div>
        @endif

        <!-- Action Buttons -->
        @if ($user->hasRole('service_provider'))
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                <a href="{{ route('portal.invoice.download', ['portal' => $portal, 'invoice' => $invoice]) }}"
                    class="bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl">
                    Download Invoice
                </a>
                <form action="{{ route('portal.invoice.destroy', ['portal' => $portal, 'invoice' => $invoice]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl w-full cursor-pointer">
                        Delete Invoice
                    </button>
                </form>

                <a href="{{ route('portal.invoice.edit', ['invoice' => $invoice, 'portal' => $portal]) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl">
                    Edit Invoice
                </a>
        @endif
    </div>
    </div>
</x-app-layout>
