<x-app-layout :portal="currentPortal()">
    <div class="mx-auto grid max-w-4xl grid-cols-1 items-center gap-6 p-4">
        {{-- Update User Form --}}
        <form
            action="{{ route('portal.invoice.update', ['invoice' => $invoice, 'portal' => currentPortal()]) }}"
            method="POST"
            class="flex flex-col gap-4 rounded-2xl bg-white p-6 shadow-xl"
        >
            @csrf
            @method('PUT')

            <h2 class="text-xl font-semibold text-gray-800">Update invoice Info</h2>

            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ $invoice->name }}"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                />
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <input
                    type="text"
                    id="description"
                    name="description"
                    value="{{ $invoice->description }}"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                />
            </div>
            <div>
                <label for="Payment" class="block font-medium text-gray-700">Payment</label>
                <input
                    type="number"
                    id="price"
                    name="payment"
                    value="{{ $invoice->price }}"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                />
            </div>
            <div>
                <label for="file" class="block font-medium text-gray-700"> File </label>

                @if ($invoice->file)
                    <p class="mt-1 text-sm text-gray-500">Current file: {{ $invoice->file->filename }}</p>
                @endif

                <input
                    type="file"
                    id="file"
                    name="file"
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                />
            </div>
            <div>
                <label for="Expiry date" class="block font-medium text-gray-700">Expiry date</label>
                <input
                    type="date"
                    id="expiry_date"
                    name="expiry_date"
                    value="{{ $invoice->expiry_date }}"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                />
            </div>
            <div>
                <label for="customer" class="block font-medium text-gray-700">Customer</label>
                <select
                    name="user"
                    id="customer"
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white p-2 focus:ring focus:ring-blue-200"
                >
                    @foreach (currentPortal()->users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="project" class="block font-medium text-gray-700">Project</label>
                <select
                    name="project"
                    id="project"
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white p-2 focus:ring focus:ring-blue-200"
                >
                    @foreach (currentPortal()->projects as $project)
                        <option value="{{ $project->id }}">{{ ucfirst($project->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button
                type="submit"
                class="cursor-pointer rounded-xl bg-green-500 p-3 text-white transition hover:bg-blue-600"
            >
                Update Invoice
            </button>
        </form>
    </div>
</x-app-layout>
