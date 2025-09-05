<x-guestLayout>
    <!-- Hero Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-28 py-20 items-center bg-blue-50">
        <div class="flex flex-col gap-6 max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">
                Professioneel klantcontact, zonder gedoe.
            </h1>
            <p class="text-lg md:text-xl text-blue-800">
                Bouw in enkele minuten een persoonlijke klantportaal voor jouw bedrijf – zonder een regel code.
            </p>
            <a href="{{ route('portal.index') }}"
               class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 px-6 rounded-2xl w-fit shadow-lg">
                Probeer gratis
            </a>
        </div>
        <img src="{{ asset('hero.jpg') }}" alt="Illustratie van een klantportaal" class="w-full rounded-xl shadow-xl">
    </section>

    <!-- Audience Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <h2 class="text-4xl font-extrabold text-blue-900 mb-12">Voor wie is dit?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-6">
                @foreach(['Freelancers', 'Creatieve bureaus', 'Consultants'] as $role)
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('anonymous_picture.jpg') }}" alt="{{ $role }}"
                             class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                        <span class="text-xl text-blue-800">{{ $role }}</span>
                    </div>
                @endforeach
            </div>
            <div class="space-y-6">
                @foreach(['Juridische & financiële dienstverleners', 'Coaches & trainers'] as $role)
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('anonymous_picture.jpg') }}" alt="{{ $role }}"
                             class="w-14 h-14 rounded-full border-2 border-blue-600 object-cover">
                        <span class="text-xl text-blue-800">{{ $role }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Problem/Solution Section -->
    <section class="bg-blue-50 py-20 px-6 md:px-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <img src="{{ asset('central.jpg') }}" alt="Illustratie van een probleem"
                 class="w-full rounded-xl shadow-lg">
            <div class="flex flex-col gap-8">
                <h2 class="text-4xl font-extrabold text-blue-900">Waarom een klantportaal?</h2>
                <p class="text-lg md:text-xl text-blue-800 leading-relaxed">
                    Veel dienstverleners hebben géén centrale plek om met hun klanten te communiceren.<br>
                    Portalease geeft je klanten een veilige, overzichtelijke plek voor samenwerking, documenten en updates.
                </p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20 px-6 md:px-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div class="flex flex-col gap-6">
                <h2 class="text-4xl font-extrabold text-blue-900">Geen technische kennis nodig</h2>
                <p class="text-lg md:text-xl text-blue-800">
                    Je hebt géén developers of dure systemen nodig. Start binnen 5 minuten en geef je klanten de ervaring die ze verdienen.
                </p>
            </div>
            <ul class="text-lg md:text-xl text-blue-900 space-y-3 list-none">
                <li>🔹 Gepersonaliseerd portaal met je eigen branding</li>
                <li>🔹 Deel veilig documenten, facturen en updates</li>
                <li>🔹 Communiceer overzichtelijk via berichten</li>
                <li>🔹 Nodig klanten uit met één klik</li>
                <li>🔹 Werk samen met je team – alles op één plek</li>
            </ul>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-600 py-20 px-6 md:px-28 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-4">Laat e-mails, Dropbox-links en losse PDF’s achter je.</h2>
        <p class="text-lg md:text-xl mb-8">Start vandaag nog met je eigen klantportaal.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('portal.index') }}"
               class="bg-white text-blue-700 hover:bg-blue-100 transition font-semibold py-3 px-6 rounded-2xl shadow">
                Probeer gratis
            </a>
            <a href="{{ route('portal.index') }}"
               class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-700 font-semibold py-3 px-6 rounded-2xl transition">
                Bekijk demo
            </a>
        </div>
    </section>
</x-guestLayout>
