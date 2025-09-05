<x-app-layout :portal="$portal">
    <div class="bg-white shadow-2xl rounded-2xl p-8 flex flex-col">
        <h2>You have succesfully payed {{ $invoice->name }}</h2>
        <a class="bg-green-500 hover:bg-blue-600 text-white rounded-xl p-3 transition cursor-pointer" href="{{ route('portal.show', $portal) }}">Return to dashboard</a>
    </div>
</x-app-layout>
