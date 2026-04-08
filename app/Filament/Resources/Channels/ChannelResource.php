<?php

namespace App\Filament\Resources\Channels;

use App\Filament\Resources\Channels\Pages\CreateChannel;
use App\Filament\Resources\Channels\Pages\EditChannel;
use App\Filament\Resources\Channels\Pages\ListChannels;
use App\Filament\Resources\Channels\Schemas\ChannelForm;
use App\Filament\Resources\Channels\Tables\ChannelsTable;
use App\Models\Channel;
use BackedEnum;
use UnitEnum; // Agregamos la importación para UnitEnum
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ChannelResource extends Resource
{
    protected static ?string $model = Channel::class;

    // Declaración de tipos exacta para evitar el error Intelephense(P1077)
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tv';
    protected static string|UnitEnum|null $navigationGroup = 'Gestión de Medios';

    protected static ?string $navigationLabel = 'TV';
    protected static ?string $modelLabel = 'Canal';
    protected static ?string $pluralModelLabel = 'Canales';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ChannelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChannelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChannels::route('/'),
            'create' => CreateChannel::route('/create'),
            'edit' => EditChannel::route('/{record}/edit'),
        ];
    }
}
