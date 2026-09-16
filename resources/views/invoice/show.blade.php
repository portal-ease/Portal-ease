<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-4xl space-y-6 rounded-2xl bg-white p-8 shadow-2xl">
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
                <form
                    action="{{ route('portal.invoice.payment', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700 sm:w-auto"
                    >
                        Pay Invoice
                    </button>
                </form>
                <a
                    href="{{ route('portal.invoice.download', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                    class="rounded-xl bg-green-500 py-3 text-white hover:bg-green-600"
                >
                    Download Invoice
                </a>
            </div>
        @endif

        <!-- Paid Notice + Delete (if paid) -->
        @if ($invoice->price == 0)
            <div class="flex flex-col justify-between gap-4 rounded-xl bg-green-100 p-4 sm:flex-row sm:items-center">
                <p class="text-xl font-semibold text-green-700">This invoice is paid</p>
                @if ($user->hasRole('service_provider') || $user->hasRole('manager'))
                    <form
                        action="{{ route('portal.invoice.destroy', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="cursor-pointer rounded-xl bg-red-600 px-4 py-2 text-white hover:bg-red-700"
                        >
                            Delete Invoice
                        </button>
                    </form>
                @endif
            </div>
        @endif

        <!-- Action Buttons -->
        @if ($user->hasRole('service_provider') || $user->hasRole('manager') || $user->hasRole('employee'))
            <div class="grid grid-cols-1 gap-4 text-center sm:grid-cols-3">
                <a
                    href="{{ route('portal.invoice.download', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                    class="rounded-xl bg-green-500 py-3 text-white hover:bg-green-600"
                >
                    Download Invoice
                </a>
                @if ($user->hasRole('service_provider') || $user->hasRole('manager'))
                    <form
                        action="{{ route('portal.invoice.destroy', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="w-full cursor-pointer rounded-xl bg-red-600 py-3 text-white hover:bg-red-700"
                        >
                            Delete Invoice
                        </button>
                    </form>
                @endif

                <a
                    href="{{ route('portal.invoice.edit', ['invoice' => $invoice, 'portal' => currentPortal()]) }}"
                    class="rounded-xl bg-blue-600 py-3 text-white hover:bg-blue-700"
                >
                    Edit Invoice
                </a>

        @endif
    </div>
    </div>
</x-app-layout>
