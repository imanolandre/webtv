<?php

namespace App\Filament\Resources\Movies\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;



class MoviesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('poster_portrait')
                    ->label('Portada')
                    ->circular()
                    ->toggleable(), // Permite ocultar/mostrar

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('year')
                    ->label('Año')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('genres')
                    ->label('Géneros')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->toggleable(),

                // Columna para el link (oculta por defecto para no llenar la tabla)
                TextColumn::make('video_url')
                    ->label('URL Video')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_visible')
                    ->label('Estado')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Añadida el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // 1. Filtro dinámico por Año
                SelectFilter::make('year')
                    ->label('Filtrar por Año')
                    ->options(
                        \App\Models\Movie::query()
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year', 'year')
                            ->toArray()
                    ),

                // 2. Filtro por Géneros (Como es un array en el modelo, usamos query)
                SelectFilter::make('genres')
                    ->label('Filtrar por Género')
                    ->multiple() // Permite elegir varios géneros a la vez
                    ->options([
                        'Acción' => 'Acción', 'Aventura' => 'Aventura', 'Animación' => 'Animación',
                        'Ciencia ficción' => 'Ciencia ficción', 'Comedia' => 'Comedia', 'Terror' => 'Terror',
                        'Drama' => 'Drama', 'Fantasía' => 'Fantasía', 'Suspense' => 'Suspense',
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when($data['values'], fn($q) =>
                            $q->whereJsonContains('genres', $data['values'])
                        )
                    ),

                // 3. Filtro de Visibilidad
                SelectFilter::make('is_visible')
                    ->label('Visibilidad')
                    ->options([
                        '1' => 'Públicas',
                        '0' => 'Ocultas',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
