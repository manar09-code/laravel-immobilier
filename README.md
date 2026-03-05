# 🏠 ImmoBnB — Test Technique Laravel

Application de gestion de réservations immobilières réalisée dans le cadre d'un test technique.

## Stack Technique

| Outil | Rôle |
|---|---|
| Laravel 12 | Framework PHP backend |
| Laravel Breeze | Authentification |
| Livewire | Composants dynamiques |
| Filament | Panel d'administration |
| TailwindCSS | Styles CSS |
| SQLite | Base de données |

## Fonctionnalités

- ✅ Authentification (inscription, connexion, déconnexion)
- ✅ Liste des propriétés avec recherche et filtre par prix
- ✅ Page détail d'une propriété
- ✅ Réservation dynamique avec Livewire (calcul du prix en temps réel)
- ✅ Vérification de disponibilité automatique
- ✅ Page "Mes réservations" avec annulation
- ✅ Panel d'administration Filament (`/admin`)

## Installation
```bash
git clone https://github.com/manar09-code/laravel-immobilier.git
cd laravel-immobilier
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

## Accès

| URL | Description |
|---|---|
| http://localhost:8000 | Application principale |
| http://localhost:8000/admin | Panel d'administration |

## Screenshots

Les captures d'écran sont disponibles dans le dossier [`screenshots/`](screenshots/).