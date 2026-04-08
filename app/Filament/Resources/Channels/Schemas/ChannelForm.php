<?php

namespace App\Filament\Resources\Channels\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ChannelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Canal')
                    ->description('Gestiona los detalles de la señal de TV')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Canal')
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->label('Tipo de Señal')
                            ->options([
                                'Nacional' => 'Nacional',
                                'Internacional' => 'Internacional',
                            ])
                            ->required(),
                        TextInput::make('stream_url')
                            ->label('URL del Stream (m3u8)')
                            ->required()
                            ->url()
                            ->columnSpanFull(),
                        FileUpload::make('logo')
                            ->label('Logo del Canal')
                            ->image()
                            ->directory('channel-logos')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Visible en la web')
                            ->default(true),
                    ])->columns(2)
            ]);
    }
}
