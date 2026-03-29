<x-app-layout :portal="$portal">
    <div class="grid grid-cols-2">
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
                        <input type="text" id="name" name="name" value="{{ old('name', $portal->name) }}" required
                               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                               placeholder="Enter portal name" aria-label="Portal Name">
                    </div>

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block font-medium text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $portal->email) }}" required
                               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                               placeholder="Enter email address" aria-label="Email Address">
                    </div>
                    @if($portal->subscription_status === "active")
                    {{-- Branding Color --}}
                    <div>
                        <label for="branding" class="block font-medium text-gray-700">Branding Colour</label>
                        <select id="branding" name="branding_color" required
                                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                                onchange="updateColorPreview(this.value)" aria-label="Branding Color">
                            <option value="">Select a color</option>
                            <option value="#FF5733" {{ $portal->branding_color === '#FF5733' ? 'selected' : '' }}>Red
                            </option>
                            <option value="#33C1FF" {{ $portal->branding_color === '#33C1FF' ? 'selected' : '' }}>Blue
                            </option>
                            <option value="#28A745" {{ $portal->branding_color === '#28A745' ? 'selected' : '' }}>Green
                            </option>
                            <option value="#FFC107" {{ $portal->branding_color === '#FFC107' ? 'selected' : '' }}>Yellow
                            </option>
                            <option value="#6F42C1" {{ $portal->branding_color === '#6F42C1' ? 'selected' : '' }}>Purple
                            </option>
                        </select>

                        <div id="colorPreview" class="w-full h-10 mt-2 rounded-md border border-gray-300"
                             style="background-color: {{ $portal->branding_color ?? 'transparent' }};">
                        </div>
                    </div>
                    @else
                        <input type="hidden" name="branding_color" value="{{ $portal->branding_color }}">
                    @endif
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
        <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-6">
            <!-- Heading -->
            <div class="text-center space-y-2">
                <h2 class="text-3xl font-bold text-gray-900">Edit Subscription</h2>
                <p class="text-gray-600">Additional verification is required to edit or stop the subscription</p>
            </div>

            <!-- Subscription status -->
            <div class="bg-gray-50 border rounded-xl p-4 text-center">
                <h3 class="text-lg font-medium text-gray-700">
                    Subscription status:
                    <span class="font-semibold text-gray-900">{{ $portal->subscription_status }}</span>
                </h3>
            </div>

            <!-- Actions -->
            <div class="flex justify-center">
                @if($portal->subscription_status === "active")
                    <form action="{{ route('portal.cancelSubscription', $portal->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="cursor-pointer px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl shadow-md transition">
                            Cancel Subscription
                        </button>
                    </form>
                @else
                    <a href="https://buy.stripe.com/eVq6oGaz8fHh0RX3up0Fi00"
                       class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md transition">
                        Subscribe Now
                    </a>
                @endif
            </div>
        </div>

    </div>
    {{-- JavaScript for live color preview --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const colorSelect = document.getElementById('branding');
            updateColorPreview(colorSelect.value); // Set preview on load
        });

        function updateColorPreview(color) {
            const previewBox = document.getElementById('colorPreview');
            previewBox.style.backgroundColor = color || 'transparent';
        }
    </script>
</x-app-layout>
