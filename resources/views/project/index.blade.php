<x-app-layout :portal="$portal">
    <!-- Top action bar -->
    <div class="flex justify-end mb-8">
        <a href="{{ route('portal.project.create', ['portal' => $portal]) }}"
            class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2 px-5 rounded-xl shadow transition duration-200">
            + New Project
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($portal->projects as $project)
            @php $status = "all"; @endphp
            <a class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition"
                href="{{ route('portal.project.show', ['project' => $project, 'portal' => $portal]) }}?status={{ $status }}">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $project->name }}</h2>
                <p class="text-sm text-gray-600">
                    Start: {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</p>
                <p class="text-sm text-gray-600">
                    End: {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</p>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500 text-lg py-10">
                No projects yet.
            </div>
        @endforelse
    </div>
</x-app-layout>
