<x-app-layout :portal="$portal">
    <div class="flex justify-center mt-10">
        <form method="POST" action="{{ route('portal.chat.store', $portal) }}"
              class="bg-white flex flex-col p-6 rounded-2xl shadow-2xl w-full max-w-xl gap-5">
            @csrf

            <h2 class="text-2xl font-bold text-gray-800">Start a New Chat</h2>

            <div class="flex flex-col">
                <label for="user1_id" class="mb-2 font-medium text-gray-700">Select a user to chat with:</label>
                <select id="user1_id" name="user1_id"
                        class="bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @foreach($users as $user)
                        @if($user->id !== Auth::id())
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="user2_id" value="{{ Auth::id() }}">

            <button type="submit"
                    class="self-start bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl text-sm transition">
                Create Chat
            </button>
        </form>
    </div>
</x-app-layout>

