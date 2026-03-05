<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Réservations';
    protected static ?string $modelLabel = 'Réservation';

    public static function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\Section::make('Détails')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Client')->relationship('user', 'name')->searchable()->preload()->required(),
                    Forms\Components\Select::make('property_id')
                        ->label('Propriété')->relationship('property', 'name')->searchable()->preload()->required(),
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Date d\'arrivée')->required()->native(false),
                    Forms\Components\DatePicker::make('end_date')
                        ->label('Date de départ')->required()->native(false),
                    Forms\Components\TextInput::make('total_price')
                        ->label('Prix total (€)')->numeric()->prefix('€'),
                    Forms\Components\Select::make('status')
                        ->label('Statut')
                        ->options([
                            'pending'   => 'En attente',
                            'confirmed' => 'Confirmée',
                            'cancelled' => 'Annulée',
                        ])->required()->default('pending'),
                    Forms\Components\Textarea::make('notes')
                        ->label('Notes')->rows(3)->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Client')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('property.name')->label('Propriété')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('start_date')->label('Arrivée')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('end_date')->label('Départ')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total')->money('EUR')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default     => 'warning',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending'   => 'En attente',
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                        default     => $state,
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending'   => 'En attente',
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                    ]),
            ])
            ->actions([])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit'   => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}