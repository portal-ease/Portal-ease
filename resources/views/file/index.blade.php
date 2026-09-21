<x-app-layout :portal="currentPortal()">
    <div class="grid grid-cols-1 gap-6">
        <h2 class="mb-2 text-lg font-semibold text-gray-800">Shared Documents:</h2>

        @forelse ($user->files as $file)
            @if ($file->visibility)
                <a
                    href="{{ route('portal.file.show', ['file' => $file, 'portal' => currentPortal()]) }}"
                    class="flex flex-col justify-between gap-2 rounded-xl bg-white p-5 shadow-md transition hover:shadow-lg sm:flex-row sm:items-center"
                >
                    <div class="flex flex-col">
                        <span class="text-md font-medium text-gray-800">{{ $file->filename }}</span>
                        <span class="text-sm text-gray-500">Shared with you</span>
                    </div>
                    <div class="text-sm text-gray-500 sm:text-right">
                        Uploaded on {{ $file->created_at->format('F j, Y') }}
                    </div>
                </a>
            @endif
        @empty
            <div class="py-10 text-center text-lg text-gray-500">No files have been shared yet.</div>
        @endforelse
    </div>
</x-app-layout>
