<x-app-layout :portal="$portal">
    <div class="grid grid-cols-1">
        {{-- Update Portal Form --}}
        <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-6">
            <form method="POST" action="{{ route('portal.update', $portal) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Make sure it's a PUT method since it's an update --}}
                <h2 class="text-2xl font-semibold text-gray-800">Edit portal records</h2>

                <div class="grid grid-cols-1 gap-7 items-center pb-6">
                    {{-- Portal Name --}}
                    <div>
                        <label for="name" class="block font-medium text-gray-700">Portal Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $portal->name) }}"
                            required
                            class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                            placeholder="Enter portal name" aria-label="Portal Name">
                    </div>

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block font-medium text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $portal->email) }}"
                            required
                            class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                            placeholder="Enter email address" aria-label="Email Address">
                    </div>
                    <div>
                        <label for="branding" class="block font-medium text-gray-700 mb-1">
                            Branding Colour
                        </label>
                        <div class="flex items-center gap-3">
                            <button
                                type="button"
                                id="color-picker"
                                class="w-10 h-10 rounded-lg border border-gray-300 shadow-sm"
                                aria-label="Choose branding colour">
                            </button>
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

                {{-- Submit Button --}}
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white rounded-xl p-3 transition">
                    Update Portal
                </button>
            </form>
            <form method="POST" action="{{ route('portal.destroy', $portal) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white rounded-xl p-3 transition">
                    Delete portal
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
