<x-guestLayout>
    <div class="max-w-md mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-6">
        <h2 class="text-2xl font-semibold text-center text-gray-800">Create New Portal</h2>

        <form method="POST" action="{{ route('portal.store') }}" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-7 items-center">
                <div>
                    <label for="name" class="block font-medium text-gray-700">Portal Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                           placeholder="Enter portal name">
                </div>

                <div>
                    <label for="email" class="block font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                           placeholder="Enter email address">
                </div>

                <div>
                    <label for="username" class="block font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                           placeholder="Enter user name">
                </div>

                <div>
                    <label for="password" class="block font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                           placeholder="Enter password">
                </div>

                <div>
                    <label for="branding" class="block font-medium text-gray-700">Branding Colour</label>
                    <select id="branding" name="branding_color" required
                            class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200"
                            onchange="updateColorPreview(this.value)">
                        <option value="">Select a color</option>
                        <option value="#FF5733">Red</option>
                        <option value="#33C1FF">Blue</option>
                        <option value="#28A745">Green</option>
                        <option value="#FFC107">Yellow</option>
                        <option value="#6F42C1">Purple</option>
                    </select>

                    <div id="colorPreview" class="w-full h-10 mt-2 rounded-md border border-gray-300"
                         style="background-color: transparent;">
                    </div>
                </div>

                <script>
                    function updateColorPreview(color) {
                        const previewBox = document.getElementById('colorPreview');
                        previewBox.style.backgroundColor = color || 'transparent';
                    }
                </script>
                <div>
                    <label for="logo" class="block font-medium text-gray-700">Portal Logo</label>
                    <input type="file" id="logo" name="logo" required
                           class="w-full border border-gray-300 rounded-md p-3 mt-1 focus:ring focus:ring-blue-200 focus:outline-none">
                </div>

            </div>
            <button type="submit"
                    class="w-full bg-green-500 hover:bg-blue-600 text-white rounded-xl p-3 transition">
                Create Portal
            </button>
        </form>
    </div>
</x-guestLayout>
