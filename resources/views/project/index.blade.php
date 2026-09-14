<x-app-layout :portal="currentPortal()">
    <!-- Top action bar -->
    <div class="mb-8 flex justify-end">
        <a
            href="{{ route('portal.project.create', ['portal' => currentPortal()]) }}"
            class="inline-flex items-center rounded-xl bg-green-500 px-5 py-2 text-sm font-semibold text-white shadow transition duration-200 hover:bg-green-600"
        >
            + New Project
        </a>
    </div>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse (currentPortal()->projects as $project)
            @php $status = 'all'; @endphp
            <a
                class="rounded-xl bg-white p-5 shadow-md transition hover:shadow-lg"
                href="{{ route('portal.project.show', ['project' => $project, 'portal' => currentPortal()]) }}?status={{ $status }}"
            >
                <h2 class="mb-2 text-lg font-semibold text-gray-800">{{ $project->name }}</h2>
                <p class="text-sm text-gray-600">
                    Start: {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}
                </p>
                <p class="text-sm text-gray-600">
                    End: {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}
                </p>
            </a>
        @empty
            <div class="col-span-full py-10 text-center text-lg text-gray-500">No projects yet.</div>
        @endforelse
    </div>
</x-app-layout>
