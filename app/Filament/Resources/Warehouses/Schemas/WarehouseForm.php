<?php

namespace App\Filament\Resources\Warehouses\Schemas;

use Filament\Schemas\Schema; // GANTI KE SCHEMA
use Filament\Forms;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ // GANTI KE COMPONENTS
                Forms\Components\Section::make('Informasi Gudang')
                    ->description('Masukkan detail lokasi penyimpanan utama.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Gudang')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label('Kode Gudang')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
