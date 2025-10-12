<x-app-layout :portal="$portal">
    <div class="max-w-6xl mx-auto grid grid-cols-1 gap-8 p-6">
                    <!-- Profile Panel -->
                    <div class="flex flex-col items-center bg-white rounded-2xl p-6 shadow-md">
                        @php
                            $baseName = $user->name . $user->id;
                            $file = \App\Models\File::whereIn('filename', [
                                $baseName . '.jpg',
                                $baseName . '.png',
                                $baseName . '.jpeg',
                            ])->first();
                        @endphp

                        @if($file)
                            <img src="{{ $file->url }}" alt="{{ $file->filename }}"
                                 class="rounded-full w-32 h-32 object-cover">
                        @else
                            <img src="{{ asset('anonymous_picture.jpg') }}" alt="{{ $user->name }}"
                                 class="rounded-full w-32 h-32 object-cover">
                        @endif

                        <h1 class="text-2xl font-bold mt-4">{{ $user->name }}</h1>
                        <a class="text-sm text-gray-500" href="mailto:{{ $user->email }}">{{ $user->email }}</a>

                        @if($user == Auth::user())
                            <a href="{{ route('portal.user.edit', ['portal' => $portal, 'user' => $user]) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white rounded-xl px-5 py-2 text-sm transition">
                                Edit profile
                            </a>
                        @endif
                    </div>
                </div>
</x-app-layout>
