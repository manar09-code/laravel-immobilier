@extends('layouts.app')
@section('title', 'Mes Réservations')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Mes réservations</h1>
            <p class="text-gray-500 mt-1">Gérez l'ensemble de vos réservations</p>
        </div>
        <a href="{{ route('properties.index') }}"
           class="px-4 py-2.5 bg-primary text-white rounded-xl hover:bg-blue-800 font-medium transition-colors text-sm">
            + Nouvelle réservation
        </a>
    </div>

    @if($bookings->isNotEmpty())
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $booking->property->name }}</h3>
                            <p class="text-sm text-gray-500 mt-0.5">
                                {{ $booking->start_date->format('d/m/Y') }} → {{ $booking->end_date->format('d/m/Y') }}
                                <span class="ml-2 text-gray-400">({{ $booking->nights }} nuit{{ $booking->nights > 1 ? 's' : '' }})</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 flex-shrink-0">
                        <div class="text-right">
                            <div class="font-bold text-gray-900">{{ number_format($booking->total_price, 0, ',', ' ') }}€</div>
                            <div class="text-xs text-gray-400">Total</div>
                        </div>

                        @php
                            $statusLabels = ['pending' => 'En attente', 'confirmed' => 'Confirmée', 'cancelled' => 'Annulée'];
                            $statusColors = ['pending' => 'bg-yellow-100 text-yellow-800', 'confirmed' => 'bg-green-100 text-green-800', 'cancelled' => 'bg-red-100 text-red-800'];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking->status] }}">
                            {{ $statusLabels[$booking->status] }}
                        </span>

                        @if($booking->status === 'pending')
                            <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        onclick="return confirm('Annuler cette réservation ?')"
                                        class="text-sm text-red-500 hover:text-red-700 font-medium transition-colors">
                                    Annuler
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $bookings->links() }}</div>
    @else
        <div class="text-center py-24 bg-white rounded-2xl border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-700 mb-1">Aucune réservation</h3>
            <p class="text-gray-400 text-sm mb-6">Vous n'avez pas encore effectué de réservation.</p>
            <a href="{{ route('properties.index') }}"
               class="px-5 py-2.5 bg-primary text-white rounded-xl hover:bg-blue-800 font-medium transition-colors text-sm">
                Explorer les propriétés
            </a>
        </div>
    @endif

</div>
@endsection