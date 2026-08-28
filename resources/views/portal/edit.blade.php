<x-app-layout :portal="$portal">
    <div class="max-w-3xl mx-auto">
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
            <div
                x-data="{ activeTab: 'general' }"
                class="mt-6"
            >
                <div class="border-b border-gray-200 px-8">
                    <nav class="flex gap-6" aria-label="Portal settings">

                        <button
                            type="button"
                            @click="activeTab = 'general'"
                            :class="activeTab === 'general'
                                ? 'border-blue-500 text-blue-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-4 border-b-2 font-medium text-sm transition cursor-pointer"
                        >
                            General
                        </button>

                        <button
                            type="button"
                            @click="activeTab = 'branding'"
                            :class="activeTab === 'branding'
                                ? 'border-blue-500 text-blue-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-4 border-b-2 font-medium text-sm transition cursor-pointer"
                        >
                            Branding
                        </button>

                        <button
                            type="button"
                            @click="activeTab = 'danger'"
                            :class="activeTab === 'danger'
                                ? 'border-red-500 text-red-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-4 border-b-2 font-medium text-sm transition cursor-pointer"
                        >
                            Danger Zone
                        </button>

                    </nav>
                </div>

                {{-- Update form --}}
                <form
                    method="POST"
                    action="{{ route('portal.update', $portal) }}"
                    enctype="multipart/form-data"
                    class="p-8"
                >
                    @csrf
                    @method('PUT')

                    {{-- General --}}
                    <div x-show="activeTab === 'general'" x-cloak class="space-y-6">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                General settings
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Configure the basic information of your portal.
                            </p>
                        </div>

                        {{-- Portal Name --}}
                        <div>
                            <label
                                for="name"
                                class="block font-medium text-gray-700"
                            >
                                Portal Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $portal->name) }}"
                                required
                                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                                placeholder="Enter portal name"
                            >
                        </div>

                        {{-- Email --}}
                        <div>
                            <label
                                for="email"
                                class="block font-medium text-gray-700"
                            >
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $portal->email) }}"
                                required
                                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                                placeholder="Enter email address"
                            >
                        </div>

                    </div>

                    {{-- Branding --}}
                    <div x-show="activeTab === 'branding'" x-cloak class="space-y-6">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Branding
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Customize the appearance of your portal.
                            </p>
                        </div>

                        {{-- Branding Colour --}}
                        <div>
                            <label
                                for="branding"
                                class="block font-medium text-gray-700 mb-1"
                            >
                                Branding Colour
                            </label>

                            <div class="flex items-center gap-3">
                                <button
                                    type="button"
                                    id="color-picker"
                                    class="w-10 h-10 rounded-lg border border-gray-300 shadow-sm"
                                    aria-label="Choose branding colour"
                                ></button>

                                <input
                                    type="text"
                                    id="branding"
                                    name="branding_color"
                                    value="{{ old('branding_color', $portal->branding_color ?? '#3B82F6') }}"
                                    required
                                    readonly
                                    class="flex-1 border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200"
                                >
                            </div>
                        </div>

                        {{-- Logo could go here --}}
                        {{--
                        <div>
                            ...
                        </div>
                        --}}

                    </div>


                    {{-- Save button --}}
                    <div
                        x-show="activeTab !== 'danger'"
                        x-cloak
                        class="mt-8 pt-6 border-t border-gray-200"
                    >
                        <button
                            type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white rounded-xl p-3 transition"
                        >
                            Save changes
                        </button>
                    </div>

                </form>

                {{-- Danger Zone --}}
                <div
                    x-show="activeTab === 'danger'"
                    x-cloak
                    class="p-8"
                >
                    <div class="border border-red-200 rounded-xl p-6">

                        <h3 class="text-lg font-semibold text-red-600">
                            Danger Zone
                        </h3>

                        <p class="text-sm text-gray-600 mt-1 mb-6">
                            Deleting your portal is permanent and cannot be undone.
                        </p>

                        <form
                            method="POST"
                            action="{{ route('portal.destroy', $portal) }}"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white rounded-xl p-3 transition"
                            >
                                Delete portal
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
