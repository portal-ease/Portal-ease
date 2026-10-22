<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-7xl space-y-6" x-data="{ search: '', view: 'list' }">
        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Documents</h1>
                <p class="mt-1 text-sm text-gray-500">Manage and organize the documents in your portal.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a
                    href="{{ route('portal.file.create', currentPortal()) }}"
                    type="button"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50"
                >
                    <x-lucide-upload class="size-4" />
                    Upload
                </a>

                {{--                <button--}}
                {{--                    type="button"--}}
                {{--                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700"--}}
                {{--                >--}}
                {{--                    <x-lucide-folder-plus class="size-4" />--}}
                {{--                    New folder--}}
                {{--                </button>--}}
            </div>
        </div>

        {{-- Search --}}
        <div class="flex flex-col gap-3 sm:flex-row">
            <div class="relative flex-1">
                <x-lucide-search class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-gray-400" />

                <input
                    type="search"
                    x-model="search"
                    placeholder="Search documents..."
                    class="w-full rounded-xl border border-gray-200 bg-white py-3 pr-4 pl-10 text-sm text-gray-900 shadow-sm transition outline-none placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10"
                />
            </div>

            <div class="flex rounded-xl border border-gray-200 bg-white p-1 shadow-sm">
                <button
                    type="button"
                    @click="view = 'list'"
                    aria-label="List view"
                    :aria-pressed="view === 'list'"
                    class="rounded-lg p-2 transition"
                    :class="view === 'list' ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50'"
                >
                    <x-lucide-list class="size-5" />
                </button>

                <button
                    type="button"
                    @click="view = 'grid'"
                    aria-label="Grid view"
                    :aria-pressed="view === 'grid'"
                    class="rounded-lg p-2 transition"
                    :class="view === 'grid' ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50'"
                >
                    <x-lucide-layout-grid class="size-5" />
                </button>
            </div>
        </div>

        {{-- Main layout --}}
        <div class="grid grid-cols-1 gap-6">
            {{-- Document browser --}}
            <section class="min-w-0 space-y-5">
                {{--                --}}
                {{-- Folders --}}
                {{--                <div>--}}
                {{--                    <div class="mb-3 flex items-center justify-between">--}}
                {{--                        <h2 class="text-sm font-semibold text-gray-900">--}}
                {{--                            Folders--}}
                {{--                        </h2>--}}

                {{--                        <span class="text-xs text-gray-500">--}}
                {{--                             0 mappen--}}
                {{--                        </span>--}}
                {{--                    </div>--}}

                {{--                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">--}}
                {{--                        @forelse ([] as $folder)--}}
                {{--                            <a--}}
                {{--                                href="{{ route('portal.documents.index', [--}}
                {{--                                    'portal' => currentPortal(),--}}
                {{--                                    'folder' => $folder,--}}
                {{--                                ]) }}"--}}
                {{--                                class="group flex items-center gap-3 rounded-xl border border-gray-200 bg-white p-4 transition hover:border-blue-200 hover:bg-blue-50/30 hover:shadow-sm"--}}
                {{--                            >--}}
                {{--                                <div class="flex size-11 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600">--}}
                {{--                                    <i data-lucide="folder" class="size-5"></i>--}}
                {{--                                </div>--}}

                {{--                                <div class="min-w-0 flex-1">--}}
                {{--                                    <p class="truncate text-sm font-medium text-gray-900">--}}
                {{--                                        {{ $folder->name }}--}}
                {{--                                    </p>--}}
                {{--                                    <p class="mt-1 text-xs text-gray-500">--}}
                {{--                                        Open folder--}}
                {{--                                    </p>--}}
                {{--                                </div>--}}

                {{--                                <i data-lucide="chevron-right" class="size-4 text-gray-400 transition group-hover:text-blue-600"></i>--}}
                {{--                            </a>--}}
                {{--                        @empty--}}
                {{--                            <div class="col-span-full rounded-xl border border-dashed border-gray-300 px-4 py-8 text-center">--}}
                {{--                                <x-lucide-folder-plus class="mx-auto size-8 text-gray-400" />--}}
                {{--                                <p class="mt-2 text-sm font-medium text-gray-700">--}}
                {{--                                    No folders yet--}}
                {{--                                </p>--}}
                {{--                                <p class="mt-1 text-sm text-gray-500">--}}
                {{--                                    Create a folder to organize your documents.--}}
                {{--                                </p>--}}
                {{--                            </div>--}}
                {{--                        @endforelse--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{-- Documents --}}
                <div>
                    <div class="mb-3 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-sm font-semibold text-gray-900">Documents</h2>

                        <span class="text-xs text-gray-500"> {{ $files->count() }} files </span>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        {{-- Table header --}}
                        <div
                            class="hidden gap-4 border-b border-gray-100 bg-gray-50 px-5 py-3 text-xs font-medium tracking-wide text-gray-500 uppercase"
                            :class="view === 'list' ? 'md:grid md:grid-cols-[minmax(0,1fr)_150px_120px_40px]' : ''"
                        >
                            <span>Name</span>
                            <span>Shared with</span>
                            <span>Date</span>
                            <span></span>
                        </div>

                        <div
                            class="divide-y divide-gray-100"
                            :class="view === 'grid'
                                ? 'grid grid-cols-1 gap-3 divide-y-0 p-3 sm:grid-cols-2 xl:grid-cols-3'
                                : ''"
                        >
                            @forelse ($files as $file)
                                <div
                                    x-show="{{ Illuminate\Support\Js::from(strtolower($file->filename)) }}.includes(search.toLowerCase())"
                                    class="group grid grid-cols-1 gap-3 px-5 py-4 transition hover:bg-gray-50"
                                    :class="view === 'grid'
                                        ? 'rounded-xl border border-gray-200 p-4 hover:border-blue-200'
                                        : 'md:grid-cols-[minmax(0,1fr)_150px_120px_40px] md:items-center md:gap-4'"
                                >
                                    <a
                                        href="{{
                                            route('portal.file.show', [
                                                'file' => $file,
                                                'portal' => currentPortal(),
                                            ])
                                        }}"
                                        class="flex min-w-0 items-center gap-3"
                                    >
                                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                            <x-lucide-file-text class="size-5" />
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-medium text-gray-900 group-hover:text-blue-700">
                                                {{ $file->filename }}
                                            </p>
                                            <p class="mt-1 text-xs text-gray-500">Shared document</p>
                                        </div>
                                    </a>

                                    <div class="flex items-center gap-2 text-sm text-gray-500">
                                        <x-lucide-users class="size-4" />
                                        <span>Shared with you</span>
                                    </div>

                                    <div class="text-sm text-gray-500">{{ $file->created_at->format('d-m-Y') }}</div>

                                    <div class="flex justify-end">
                                        <a
                                            href="{{
                                                route('portal.file.show', [
                                                    'file' => $file,
                                                    'portal' => currentPortal(),
                                                ])
                                            }}"
                                            aria-label="Open document"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                        >
                                            <x-lucide-arrow-up-right class="size-4" />
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="px-5 py-14 text-center">
                                    <div class="mx-auto flex size-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                                        <x-lucide-files class="size-7" />
                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-gray-900">No documents found</h3>

                                    <p class="mt-1 text-sm text-gray-500">No shared documents are available yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
