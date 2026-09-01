@php use App\Services\FileStorageService; @endphp
<x-app-layout :portal="currentPortal()">
    @php
        $logoPath = app(FileStorageService::class)->portalLogoUrl(currentPortal());
    @endphp
    <div x-data="{ activeTab: 'general' }" class="max-w-3xl mx-auto">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-8 pt-8">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Edit portal
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage your portal settings and configuration.
                </p>
            </div>

            {{-- Tabs --}}
            <div class="mt-6">
                <div class="border-b border-gray-200 px-8 overflow-x-auto">
                    <nav class="flex gap-6 min-w-max" aria-label="Portal settings">
                        {{-- General --}}
                        <button type="button" @click="activeTab = 'general'"
                            :class="activeTab === 'general'
                                ?
                                'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="flex items-center gap-2 py-4 border-b-2 font-medium text-sm transition cursor-pointer">
                            <x-lucide-settings-2 width="20" height="20" />

                            <span>General</span>
                        </button>

                        {{-- Branding --}}
                        <button type="button" @click="activeTab = 'branding'"
                            :class="activeTab === 'branding'
                                ?
                                'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="flex items-center gap-2 py-4 border-b-2 font-medium text-sm transition cursor-pointer">
                            <x-lucide-palette width="20" height="20" />

                            <span>Branding</span>
                        </button>

                        {{-- Logos --}}
                        <button type="button" @click="activeTab = 'logos'"
                            :class="activeTab === 'logos'
                                ?
                                'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="flex items-center gap-2 py-4 border-b-2 font-medium text-sm transition cursor-pointer">
                            <x-lucide-image width="20" height="20" />

                            <span>Logos</span>
                        </button>

                        {{-- Danger Zone --}}
                        <button type="button" @click="activeTab = 'danger'"
                            :class="activeTab === 'danger'
                                ?
                                'border-red-500 text-red-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="flex items-center gap-2 py-4 border-b-2 font-medium text-sm transition cursor-pointer">
                            <x-lucide-circle-alert width="20" height="20" />

                            <span>Danger Zone</span>
                        </button>
                    </nav>
                </div>

                {{-- Settings form --}}
                <form method="POST" action="{{ route('portal.update', currentPortal()) }}" enctype="multipart/form-data"
                    class="p-8">
                    @csrf
                    @method('PUT')

                    {{-- General --}}
                    <div x-show="activeTab === 'general'" x-cloak class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                General settings
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Configure the basic information of your portal.
                            </p>
                        </div>

                        {{-- Portal Name --}}
                        <div>
                            <label for="name" class="block font-medium text-gray-700">
                                Portal Name
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name', currentPortal()->name) }}"
                                required
                                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                                placeholder="Enter portal name">

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block font-medium text-gray-700">
                                Email Address
                            </label>

                            <input type="email" id="email" name="email"
                                value="{{ old('email', currentPortal()->email) }}" required
                                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                                placeholder="Enter email address">

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Branding --}}
                    <div x-show="activeTab === 'branding'" x-cloak class="space-y-6">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Branding
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Customize the appearance of your portal.
                            </p>
                        </div>

                        {{-- Branding Colour --}}
                        <div>
                            <label for="branding" class="block font-medium text-gray-700 mb-1">
                                Branding Colour
                            </label>

                            <div class="flex items-center gap-3">
                                <button type="button" id="color-picker"
                                    class="w-10 h-10 rounded-lg border border-gray-300 shadow-sm"
                                    aria-label="Choose branding colour"></button>

                                <input type="text" id="branding" name="branding_color"
                                    value="{{ old('branding_color', currentPortal()->branding_color ?? '#3B82F6') }}" required
                                    readonly
                                    class="flex-1 border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200">
                            </div>

                            @error('branding_color')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Logos --}}
                    <div x-show="activeTab === 'logos'" x-cloak class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Logos
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Manage the logos displayed throughout your portal.
                            </p>
                        </div>

                        {{-- Current Logo --}}
                        <div>
                            <label class="block font-medium text-gray-700 mb-2">
                                Portal Logo
                            </label>

                            <div class="border border-gray-200 rounded-xl p-6">
                                @if ($logoPath)
                                    <div class="flex items-center gap-6">
                                        <div class="w-32 h-20 flex items-center justify-center p-3">
                                            <img src="{{ $logoPath }}" alt="{{ currentPortal()->name }} logo"
                                                class="max-w-full max-h-full object-contain">
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-800">
                                                Current logo
                                            </p>

                                            <p class="text-sm text-gray-500 mt-1">
                                                This logo is currently used by your portal.
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-6">
                                        <x-lucide-image width="40" height="40" class="mx-auto text-gray-400" />

                                        <p class="mt-3 font-medium text-gray-700">
                                            No logo uploaded
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Upload a logo to customize your portal.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Upload Logo --}}
                        <div>
                            <label for="logo" class="block font-medium text-gray-700 mb-1">
                                Upload new logo
                            </label>

                            <input type="file" id="logo" name="logo" accept="image/png,image/jpeg"
                                class="w-full border border-gray-300 rounded-md p-2 bg-white">

                            <p class="mt-1 text-sm text-gray-500">
                                PNG, JPG or JPEG.
                            </p>

                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Save button --}}
                    <div x-show="activeTab !== 'danger'" x-cloak class="mt-8">
                        <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white rounded-xl p-3 transition cursor-pointer">
                            Save changes
                        </button>
                    </div>
                </form>

                {{-- Danger Zone --}}
                <div x-show="activeTab === 'danger'" x-cloak class="p-8">
                    <div class="border border-red-200 bg-red-50 rounded-xl p-6">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0">
                                <x-lucide-circle-alert width="24" height="24" class="text-red-600" />
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-red-600">
                                    Danger Zone
                                </h3>

                                <p class="text-sm text-gray-600 mt-1">
                                    Deleting your portal is permanent and cannot be undone.
                                    All associated data may be deleted as well.
                                </p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('portal.destroy', currentPortal()) }}" class="mt-6">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white rounded-xl p-3 transition cursor-pointer">
                                Delete portal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
