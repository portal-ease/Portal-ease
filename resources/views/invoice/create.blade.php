<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-xl space-y-6 rounded-2xl bg-white p-8 shadow-2xl">
        <h2 class="text-2xl font-semibold text-gray-800">New invoice</h2>

        <form
            action="{{ route('portal.invoice.store', ['portal' => currentPortal()]) }}"
            method="POST"
            class="space-y-4"
            enctype="multipart/form-data"
        >
            @csrf

            <div>
                <label for="name" class="block font-medium text-gray-700">Invoice name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="Invoice name"
                />
            </div>

            <div>
                <label for="file" class="block font-medium text-gray-700">File</label>
                <input
                    type="file"
                    id="file"
                    name="file"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="File"
                />
            </div>
            <div>
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <input
                    type="text"
                    id="description"
                    name="description"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 py-14 focus:ring focus:ring-blue-200"
                    placeholder="description"
                />
            </div>
            <div>
                <label for="expiry date" class="block font-medium text-gray-700">Expiration date</label>
                <input
                    type="date"
                    id="date"
                    name="expiry_date"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="expiry date"
                />
            </div>
            <div>
                <label for="payment" class="block font-medium text-gray-700">Invoice payment</label>
                <input
                    type="number"
                    id="payment"
                    name="payment"
                    required
                    class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200"
                    placeholder="invoice payment"
                />
            </div>
            <div>
                <label for="user" class="block font-medium text-gray-700">User</label>
                <select
                    name="user"
                    id="user"
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white p-2 focus:ring focus:ring-blue-200"
                >
                    @foreach (currentPortal()->users as $user)
                        @if ($user->hasRole('client'))
                            <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                        @endif
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
                class="w-full cursor-pointer rounded-xl bg-green-500 p-3 text-white transition hover:bg-blue-600"
            >
                Place invoice
            </button>
        </form>
    </div>
</x-app-layout>
