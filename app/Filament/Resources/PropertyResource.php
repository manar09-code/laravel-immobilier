<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Propriétés';
    protected static ?string $modelLabel = 'Propriété';
    protected static ?string $pluralModelLabel = 'Propriétés';

    public static function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\Section::make('Informations générales')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom')->required()->maxLength(255)->columnSpanFull(),
                    Forms\Components\TextInput::make('location')
                        ->label('Localisation')->maxLength(255),
                    Forms\Components\TextInput::make('price_per_night')
                        ->label('Prix par nuit (€)')->required()->numeric()->prefix('€'),
                    Forms\Components\TextInput::make('max_guests')
                        ->label('Voyageurs max')->required()->numeric()->default(1),
                    Forms\Components\Textarea::make('description')
                        ->label('Description')->required()->rows(4)->columnSpanFull(),
                    Forms\Components\Toggle::make('is_available')
                        ->label('Disponible')->default(true),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Localisation')->searchable(),
                Tables\Columns\TextColumn::make('price_per_night')->label('Prix / nuit')->money('EUR')->sortable(),
                Tables\Columns\TextColumn::make('max_guests')->label('Voyageurs')->sortable(),
                Tables\Columns\IconColumn::make('is_available')->label('Disponible')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_available')->label('Disponibilité'),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit'   => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}