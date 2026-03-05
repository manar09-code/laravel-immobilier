<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

    <h2 class="text-xl font-bold text-gray-900 mb-1">Réserver ce bien</h2>
    <p class="text-sm text-gray-500 mb-6">
        À partir de <span class="font-semibold text-primary">{{ number_format($property->price_per_night, 0, ',', ' ') }}€</span> / nuit
    </p>

    @if($bookingSuccess)
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4 text-center">
            <svg class="w-8 h-8 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="font-semibold text-green-800">Réservation effectuée !</p>
            <p class="text-sm text-green-600 mt-1">Votre demande est en attente de confirmation.</p>
            <a href="{{ route('bookings.index') }}"
               class="inline-block mt-3 text-sm text-green-700 underline font-medium">
                Voir mes réservations →
            </a>
        </div>
    @endif

    <div class="space-y-4">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Date d'arrivée</label>
            <input type="date"
                   wire:model.live="startDate"
                   min="{{ date('Y-m-d') }}"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary @error('startDate') border-red-400 @enderror">
            @error('startDate')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Date de départ</label>
            <input type="date"
                   wire:model.live="endDate"
                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary @error('endDate') border-red-400 @enderror">
            @error('endDate')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        @if($availabilityMessage === 'available')
            <div class="flex items-center gap-2 px-3 py-2 bg-green-50 border border-green-200 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                <span class="text-sm text-green-700 font-medium">Disponible pour ces dates</span>
            </div>
        @elseif($availabilityMessage === 'unavailable')
            <div class="flex items-center gap-2 px-3 py-2 bg-red-50 border border-red-200 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                <span class="text-sm text-red-700 font-medium">Non disponible pour ces dates</span>
            </div>
        @endif

        @if($totalPrice !== null && $nights !== null)
            <div class="bg-gray-50 rounded-xl p-4 space-y-2">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>{{ number_format($property->price_per_night, 0, ',', ' ') }}€ × {{ $nights }} nuit{{ $nights > 1 ? 's' : '' }}</span>
                    <span>{{ number_format($totalPrice, 0, ',', ' ') }}€</span>
                </div>
                <div class="border-t border-gray-200 pt-2 flex justify-between font-bold text-gray-900">
                    <span>Total</span>
                    <span class="text-primary text-lg">{{ number_format($totalPrice, 0, ',', ' ') }}€</span>
                </div>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                Notes <span class="text-gray-400 font-normal">(optionnel)</span>
            </label>
            <textarea wire:model="notes"
                      rows="3"
                      placeholder="Heure d'arrivée, besoins spéciaux..."
                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-none"></textarea>
        </div>

        @auth
            <button wire:click="book"
                    wire:loading.attr="disabled"
                    @if(!$property->is_available || $availabilityMessage === 'unavailable') disabled @endif
                    class="w-full py-3 bg-primary text-white rounded-xl font-semibold hover:bg-blue-800 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="book">Réserver maintenant</span>
                <span wire:loading wire:target="book" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    Traitement en cours...
                </span>
            </button>
        @else
            <a href="{{ route('login') }}"
               class="w-full block text-center py-3 bg-primary text-white rounded-xl font-semibold hover:bg-blue-800 transition-colors">
                Connectez-vous pour réserver
            </a>
        @endauth

    </div>

    <p class="text-xs text-gray-400 text-center mt-4">Aucun frais prélevé maintenant · Annulation flexible</p>
</div>