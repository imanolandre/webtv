<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class MovieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información General')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required(),
                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(3),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('year')
                                    ->label('Año')
                                    ->numeric()
                                    ->required(),
                                Select::make('genres')
                                    ->label('Géneros')
                                    ->multiple()
                                    ->searchable()
                                    ->options([
                                        'Acción' => 'Acción', 'Aventura' => 'Aventura', 'Animación' => 'Animación',
                                        'Ciencia ficción' => 'Ciencia ficción', 'Comedia' => 'Comedia', 'Crimen' => 'Crimen',
                                        'Documental' => 'Documental', 'Drama' => 'Drama', 'Familia' => 'Familia',
                                        'Fantasía' => 'Fantasía', 'Historia' => 'Historia', 'Terror' => 'Terror',
                                        'Kids' => 'Kids', 'Misterio' => 'Misterio', 'Música' => 'Música',
                                        'Película de TV' => 'Película de TV', 'Reality' => 'Reality', 'Romance' => 'Romance',
                                        'Sci-Fi & Fantasy' => 'Sci-Fi & Fantasy', 'Suspense' => 'Suspense',
                                        'War & Politics' => 'War & Politics', 'Western' => 'Western',
                                        'Action & Adventure' => 'Action & Adventure', 'Bélica' => 'Bélica'
                                    ]),
                            ]),
                        TextInput::make('video_url')
                            ->label('Enlace del Video')
                            ->url()
                            ->required(),
                    ]),

                Section::make('Multimedia')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('poster_portrait')
                                    ->label('Portada (Vertical)')
                                    ->image()
                                    ->directory('movies/portraits')
                                    ->required(),
                                FileUpload::make('poster_landscape')
                                    ->label('Fondo (Horizontal)')
                                    ->image()
                                    ->directory('movies/landscapes')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Estado')
                    ->schema([
                        Toggle::make('is_visible')
                            ->label('Visible en la web')
                            ->default(true),
                    ]),
            ]);
    }
}
