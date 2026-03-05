@extends('layouts.app')
@section('title', $property->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('properties.index') }}" class="hover:text-primary transition-colors">Propriétés</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-900 font-medium">{{ $property->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left: Property Details -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Image -->
            <div class="h-72 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-2xl overflow-hidden">
                @if($property->image)
                    <img src="{{ asset('storage/' . $property->image) }}"
                         alt="{{ $property->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $property->name }}</h1>
                        @if($property->location)
                            <p class="text-gray-500 flex items-center gap-1 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $property->location }}
                            </p>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-primary">{{ number_format($property->price_per_night, 0, ',', ' ') }}€</div>
                        <div class="text-sm text-gray-500">par nuit</div>
                    </div>
                </div>

                <div class="flex items-center gap-4 py-4 border-y border-gray-100 mb-4">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>{{ $property->max_guests }} voyageurs max</span>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($property->is_available)
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            <span class="text-green-600 font-medium text-sm">Disponible</span>
                        @else
                            <span class="w-2 h-2 rounded-full bg-red-400"></span>
                            <span class="text-red-600 font-medium text-sm">Indisponible</span>
                        @endif
                    </div>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-900 mb-2">Description</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>
                </div>
            </div>
        </div>

        <!-- Right: Booking Widget (Livewire) -->
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                @livewire('booking-manager', ['property' => $property])
            </div>
        </div>

    </div>
</div>
@endsection