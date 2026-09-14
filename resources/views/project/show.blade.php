<x-app-layout :portal="currentPortal()">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">{{ $project->name }}</h1>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Project Details -->
        <div class="rounded-xl bg-white p-6 shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Project Details</h2>
            <div class="space-y-2 text-gray-700">
                <p><span class="font-medium">Name:</span> {{ $project->name }}</p>
                <p><span class="font-medium">Status:</span> {{ $project->status }}</p>
                <p><span class="font-medium">Deadline:</span> {{ $project->end_date }}</p>
                @if (\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
                    <p><span class="font-medium">Customer:</span> {{ $project->customer->name }}</p>
                    <div class="flex flex-row gap-12">
                        <form
                            method="POST"
                            action="{{ route('portal.project.destroy', ['project' => $project, 'portal' => currentPortal()]) }}"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Are you sure?');"
                                class="cursor-pointer rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white shadow transition duration-200 hover:bg-green-800"
                            >
                                Finish Project
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="rounded-xl bg-white p-6 shadow-md">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">
                    Payment
                    @foreach (currentPortal()->invoices as $invoice)
                        @if ($invoice->project_id == $project->id)
                            <h2>${{ $invoice->price }}</h2>
                        @endif
                    @endforeach
                </h2>
            </div>
            <div class="rounded-xl bg-white p-6 shadow-md">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Invoice(s)</h2>
                @foreach (currentPortal()->invoices as $invoice)
                    @if ($invoice->project_id == $project->id)
                        <a
                            href="{{ route('portal.invoice.show', ['portal' => currentPortal(), 'invoice' => $invoice]) }}"
                            class="hover:text-blue-300"
                        >{{ $invoice->name }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
