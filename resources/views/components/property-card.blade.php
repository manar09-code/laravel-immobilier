@props(['property'])

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group">

    <div class="h-48 bg-gradient-to-br from-primary/20 to-secondary/20 relative overflow-hidden">
        @if($property->image)
            <img src="{{ asset('storage/' . $property->image) }}"
                 alt="{{ $property->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-16 h-16 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
        @endif

        <div class="absolute top-3 right-3">
            @if($property->is_available)
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                    Disponible
                </span>
            @else
                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                    Indisponible
                </span>
            @endif
        </div>
    </div>

    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $property->name }}</h3>

        @if($property->location)
            <p class="text-sm text-gray-500 flex items-center gap-1 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $property->location }}
            </p>
        @endif

        <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $property->description }}</p>

        <div class="flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold text-primary">{{ number_format($property->price_per_night, 0, ',', ' ') }}€</span>
                <span class="text-sm text-gray-500">/ nuit</span>
            </div>
            <div class="flex items-center gap-1 text-sm text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                {{ $property->max_guests }} pers. max
            </div>
        </div>

        <a href="{{ route('properties.show', $property) }}"
           class="mt-4 w-full block text-center px-4 py-2.5 bg-primary text-white rounded-xl hover:bg-blue-800 font-medium transition-colors">
            Voir le bien
        </a>
    </div>
</div>