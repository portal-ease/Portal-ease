<x-app-layout :portal="currentPortal()">
    <div class="grid grid-cols-1 gap-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Shared Documents:</h2>

        @forelse($user->files as $file)
            @if (!$file->visibility)
                <a href="{{ route('portal.file.show', ['file' => $file, 'portal' => currentPortal()]) }}"
                    class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col sm:flex-row sm:items-center justify-between gap-2">
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
            <div class="text-center text-gray-500 text-lg py-10">
                No files have been shared yet.
            </div>
        @endforelse
    </div>
</x-app-layout>
