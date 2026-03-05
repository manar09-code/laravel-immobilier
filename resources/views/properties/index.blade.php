@extends('layouts.app')
@section('title', 'Nos Propriétés')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">Trouvez votre bien idéal</h1>
        <p class="text-lg text-gray-500 max-w-xl mx-auto">
            Découvrez notre sélection de propriétés de prestige pour vos vacances ou séjours professionnels.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex flex-col sm:flex-row gap-3">
        <form method="GET" action="{{ route('properties.index') }}" class="flex flex-1 gap-3 flex-wrap">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Rechercher un bien, une ville..."
                   class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">

            <input type="number"
                   name="max_price"
                   value="{{ request('max_price') }}"
                   placeholder="Prix max / nuit"
                   class="w-44 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">

            <button type="submit"
                    class="px-6 py-2.5 bg-primary text-white rounded-xl hover:bg-blue-800 font-medium transition-colors text-sm">
                Filtrer
            </button>

            @if(request()->hasAny(['search', 'max_price']))
                <a href="{{ route('properties.index') }}"
                   class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 font-medium transition-colors text-sm">
                    Réinitialiser
                </a>
            @endif
        </form>
    </div>

    <p class="text-sm text-gray-500 mb-6">{{ $properties->total() }} propriété(s) trouvée(s)</p>

    @if($properties->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <x-property-card :property="$property" />
            @endforeach
        </div>
        <div class="mt-10">
            {{ $properties->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-24">
            <h3 class="text-lg font-semibold text-gray-700 mb-1">Aucune propriété trouvée</h3>
            <p class="text-gray-400 text-sm">Essayez d'autres critères de recherche.</p>
        </div>
    @endif
</div>
@endsection