<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-4xl space-y-8 rounded-2xl bg-white p-8 shadow-2xl">
        <!-- File Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">{{ $file->filename }}</h2>
            <p class="mt-2 text-sm text-gray-500">Shared file</p>
        </div>

        <!-- File Info -->
        <div class="space-y-2 text-gray-700">
            <p><span class="font-semibold">File name:</span> {{ $file->filename }}</p>
            <p>
                <span class="font-semibold">Visibility:</span>
                @if ($file->visibility)
                    <span class="font-medium text-green-600">Visible</span>
                @else
                    <span class="font-medium text-red-500">Not visible</span>
                @endif
            </p>
        </div>

        <!-- Actions -->
        <div class="grid grid-cols-1 gap-4 text-center sm:grid-cols-3">
            <a
                href="{{ route('portal.file.download', ['portal' => currentPortal(), 'file' => $file]) }}"
                class="rounded-xl bg-blue-600 py-3 font-medium text-white shadow transition hover:bg-blue-700"
            >
                📥 Download file
            </a>
        </div>
    </div>
</x-app-layout>
