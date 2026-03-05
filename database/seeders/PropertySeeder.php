<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            [
                'name'            => 'Villa Méditerranée',
                'description'     => 'Magnifique villa avec piscine et vue mer, idéale pour les vacances en famille. Terrasse spacieuse, cuisine équipée, 4 chambres avec salle de bain privée.',
                'price_per_night' => 250.00,
                'location'        => 'Nice, Côte d\'Azur',
                'max_guests'      => 8,
                'is_available'    => true,
            ],
            [
                'name'            => 'Appartement Centre-Ville',
                'description'     => 'Appartement moderne au coeur de Paris, à deux pas des musées et restaurants. Idéal pour les séjours culturels, tout équipé.',
                'price_per_night' => 120.00,
                'location'        => 'Paris, Île-de-France',
                'max_guests'      => 4,
                'is_available'    => true,
            ],
            [
                'name'            => 'Chalet Montagnard',
                'description'     => 'Chalet authentique avec vue sur les Alpes, cheminée et jacuzzi extérieur. Accès direct aux pistes de ski en hiver, randonnées en été.',
                'price_per_night' => 180.00,
                'location'        => 'Chamonix, Alpes',
                'max_guests'      => 6,
                'is_available'    => true,
            ],
            [
                'name'            => 'Maison de Campagne',
                'description'     => 'Charmante maison provençale entourée de lavandes et de vignes. Ambiance bucolique, piscine privée, grand jardin et terrasse barbecue.',
                'price_per_night' => 95.00,
                'location'        => 'Luberon, Provence',
                'max_guests'      => 5,
                'is_available'    => true,
            ],
            [
                'name'            => 'Loft Industriel Bordeaux',
                'description'     => 'Loft design de 120m² dans un ancien entrepôt rénové. Hauteur sous plafond de 5m, cuisine ouverte, salle de sport privative.',
                'price_per_night' => 140.00,
                'location'        => 'Bordeaux, Nouvelle-Aquitaine',
                'max_guests'      => 4,
                'is_available'    => true,
            ],
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}