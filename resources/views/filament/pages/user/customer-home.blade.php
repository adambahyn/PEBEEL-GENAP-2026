<x-filament-panels::page>

    {{-- ===== HERO SECTION ===== --}}
    <div class="relative bg-gray-900 rounded-2xl overflow-hidden shadow-2xl mb-12">
        <img
            src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=2070&auto=format&fit=crop"
            alt="Hero Car"
            class="absolute inset-0 w-full h-full object-cover opacity-50"
        >

        <div class="relative z-10 px-8 py-20 md:py-32 flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight">
                Temukan Perjalananmu.
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl">
                Sewa mobil impianmu dari host lokal terpercaya di seluruh Indonesia. Mudah, aman, dan tanpa ribet.
            </p>

            {{-- Search Bar --}}
            <div class="bg-white p-4 rounded-full shadow-lg flex flex-col md:flex-row items-center gap-4 w-full max-w-4xl">
                <div class="flex-1 w-full px-4 border-b md:border-b-0 md:border-r border-gray-200 pb-2 md:pb-0">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Lokasi</label>
                    <input
                        type="text"
                        placeholder="Kota, bandara, atau alamat"
                        class="w-full focus:outline-none text-gray-800 font-medium bg-transparent"
                    >
                </div>
                <div class="flex-1 w-full px-4 border-b md:border-b-0 md:border-r border-gray-200 pb-2 md:pb-0">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Dari Tanggal</label>
                    <input type="date" class="w-full focus:outline-none text-gray-800 font-medium bg-transparent">
                </div>
                <div class="flex-1 w-full px-4 pb-2 md:pb-0">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Sampai Tanggal</label>
                    <input type="date" class="w-full focus:outline-none text-gray-800 font-medium bg-transparent">
                </div>
                <button type="button" class="w-full md:w-auto bg-primary-600 hover:bg-primary-700 text-white rounded-full p-4 transition shadow-md">
                    <x-heroicon-o-magnifying-glass class="w-6 h-6" />
                </button>
            </div>
        </div>
    </div>

    {{-- ===== STATISTIK SINGKAT ===== --}}
    <div class="grid grid-cols-3 gap-4 mb-12 text-center">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            <p class="text-3xl font-extrabold text-primary-600">{{ $cars->count() }}+</p>
            <p class="text-sm text-gray-500 mt-1">Mobil Tersedia</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            <p class="text-3xl font-extrabold text-primary-600">10+</p>
            <p class="text-sm text-gray-500 mt-1">Kota Terjangkau</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            <p class="text-3xl font-extrabold text-primary-600">4.9★</p>
            <p class="text-sm text-gray-500 mt-1">Rating Rata-rata</p>
        </div>
    </div>

    {{-- ===== DAFTAR MOBIL ===== --}}
    <div>
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Rekomendasi Mobil Tersedia</h2>
            <a href="/product" class="text-primary-600 font-semibold hover:underline text-sm">Lihat Semua →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($cars as $car)
                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition border border-gray-100 dark:border-gray-700 group cursor-pointer">

                    {{-- Gambar Mobil --}}
                    <div class="aspect-[4/3] w-full bg-gray-200 relative overflow-hidden">
                        @if ($car->image)
                            <img
                                src="{{ asset('storage/' . $car->image) }}"
                                alt="{{ $car->name }}"
                                class="object-cover w-full h-full group-hover:scale-105 transition duration-500"
                            >
                        @else
                            <img
                                src="https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop"
                                alt="{{ $car->name }}"
                                class="object-cover w-full h-full group-hover:scale-105 transition duration-500"
                            >
                        @endif

                        {{-- Badge tipe kendaraan --}}
                        @if ($car->type)
                            <div class="absolute top-3 right-3 bg-primary-600 text-white px-2 py-1 rounded-md text-xs font-bold shadow-sm">
                                {{ $car->type }}
                            </div>
                        @endif

                        {{-- Badge stok/ketersediaan --}}
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold text-gray-800 shadow-sm">
                            ⭐ 4.9
                        </div>
                    </div>

                    {{-- Info Mobil --}}
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white line-clamp-1">
                            {{ $car->name }}
                        </h3>

                        {{-- ✅ FIX: gunakan $car->type dan $car->location (bukan type_location yang tidak ada) --}}
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                            <x-heroicon-o-map-pin class="w-4 h-4 shrink-0" />
                            <span class="line-clamp-1">
                                {{ $car->location ?? 'Tersedia di Kota Anda' }}
                            </span>
                        </p>

                        {{-- Stok --}}
                        <p class="text-xs mt-1 {{ $car->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $car->stock > 0 ? "Stok: {$car->stock} unit" : 'Tidak tersedia' }}
                        </p>

                        {{-- Harga & Tombol Booking --}}
                        <div class="mt-4 flex items-center justify-between gap-2">
                            <div>
                                <span class="font-extrabold text-lg text-primary-600 dark:text-primary-400">
                                    Rp {{ number_format($car->price, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-gray-500">/ hari</span>
                            </div>
                            <a
                                href="/payment"
                                class="bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold px-3 py-2 rounded-lg transition shrink-0"
                            >
                                Booking
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-gray-500 dark:text-gray-400">
                    <x-heroicon-o-truck class="w-12 h-12 mx-auto mb-3 opacity-40" />
                    <p class="font-medium">Belum ada mobil yang tersedia.</p>
                    <p class="text-sm mt-1">Silakan coba lagi nanti.</p>
                </div>
            @endforelse
        </div>
    </div>

</x-filament-panels::page>
