<x-app-layout :portal="currentPortal()">
    <div class="max-w-4xl mx-auto grid grid-cols-1 items-center gap-6 p-4">

        {{-- Update User Form --}}
        <form action="{{ route('portal.invoice.update', ['invoice' => $invoice, 'portal' => currentPortal()]) }}"
            method="POST" class="bg-white shadow-xl rounded-2xl p-6 flex flex-col gap-4">
            @csrf
            @method('PUT')

            <h2 class="text-xl font-semibold text-gray-800">Update invoice Info</h2>

            <div>
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ $invoice->name }}" required
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <input type="text" id="description" name="description" value="{{ $invoice->description }}" required
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="Payment" class="block font-medium text-gray-700">Payment</label>
                <input type="number" id="price" name="payment" value="{{ $invoice->price }}" required
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="file" class="block font-medium text-gray-700">
                    File
                </label>

                @if ($invoice->file)
                    <p class="mt-1 text-sm text-gray-500">
                        Current file: {{ $invoice->file->filename }}
                    </p>
                @endif

                <input type="file" id="file" name="file"
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="Expiry date" class="block font-medium text-gray-700">Expiry date</label>
                <input type="date" id="expiry_date" name="expiry_date" value="{{ $invoice->expiry_date }}" required
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label for="customer" class="block font-medium text-gray-700">Customer</label>
                <select name="user" id="customer"
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 bg-white focus:ring focus:ring-blue-200">
                    @foreach (currentPortal()->users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="project" class="block font-medium text-gray-700">Project</label>
                <select name="project" id="project"
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 bg-white focus:ring focus:ring-blue-200">
                    @foreach (currentPortal()->projects as $project)
                        <option value="{{ $project->id }}">{{ ucfirst($project->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="bg-green-500 hover:bg-blue-600 text-white rounded-xl p-3 transition cursor-pointer">
                Update Invoice
            </button>
        </form>
    </div>
</x-app-layout>
