<?php

namespace App\Filament\Resources\Warehouses;

use App\Filament\Resources\Warehouses\Pages;
use App\Filament\Resources\Warehouses\Schemas\WarehouseForm;
use App\Filament\Resources\Warehouses\Tables\WarehousesTable;
use App\Models\Warehouse;
use Filament\Schemas\Schema; // GANTI KE SCHEMA
use Filament\Resources\Resource;
use Filament\Tables\Table;

class WarehouseResource extends Resource
{
    protected static ?string $model = Warehouse::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Gudang';

    // GANTI KE SCHEMA
    public static function form(Schema $schema): Schema
    {
        return WarehouseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WarehousesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarehouses::route('/'),
            'create' => Pages\CreateWarehouse::route('/create'),
            'edit' => Pages\EditWarehouse::route('/{record}/edit'),
        ];
    }
}
