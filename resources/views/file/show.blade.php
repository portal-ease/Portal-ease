<x-app-layout :portal="$portal">
    <div class="bg-white shadow-2xl rounded-2xl p-8 space-y-8 max-w-4xl mx-auto">
        <!-- File Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">{{ $file->filename }}</h2>
            <p class="text-sm text-gray-500 mt-2">Shared file</p>
        </div>

        <!-- File Info -->
        <div class="space-y-2 text-gray-700">
            <p><span class="font-semibold">File name:</span> {{ $file->filename }}</p>
            <p>
                <span class="font-semibold">Visibility:</span>
                @if (!$file->visibility)
                    <span class="text-green-600 font-medium">Visible</span>
                @else
                    <span class="text-red-500 font-medium">Not visible</span>
                @endif
            </p>
        </div>

        <!-- Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
            <a href="{{ route('portal.file.download', ['portal' => $portal, 'file' => $file]) }}"
                class="bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-xl font-medium shadow">
                📥 Download file
            </a>
        </div>
    </div>
</x-app-layout>
