<?php

namespace App\Filament\Resources\Channels\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;

class ChannelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->circular()
                    ->label('Logo'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Canal'),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Nacional' => 'success',
                        'Internacional' => 'warning',
                        default => 'gray',
                    })
                    ->label('Tipo'),
                ToggleColumn::make('is_active')
                    ->label('Estado'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'Nacional' => 'Nacional',
                        'Internacional' => 'Internacional',
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
