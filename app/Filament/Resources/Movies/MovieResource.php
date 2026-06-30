<?php

namespace App\Filament\Resources\Movies;

use App\Filament\Resources\Movies\Pages\CreateMovie;
use App\Filament\Resources\Movies\Pages\EditMovie;
use App\Filament\Resources\Movies\Pages\ListMovies;
use App\Filament\Resources\Movies\Schemas\MovieForm;
use App\Filament\Resources\Movies\Tables\MoviesTable;
use App\Models\Movie;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    // Tipado exacto para evitar errores P1077
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-film';
    protected static string|UnitEnum|null $navigationGroup = 'Gestión de Medios';

    protected static ?string $navigationLabel = 'Películas';
    protected static ?string $modelLabel = 'Película';
    protected static ?string $pluralModelLabel = 'Películas';

    public static function form(Schema $schema): Schema
    {
        return MovieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MoviesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMovies::route('/'),
            'create' => CreateMovie::route('/create'),
            'edit' => EditMovie::route('/{record}/edit'),
        ];
    }
}
