<?php

namespace App\Filament\Resources\Warehouses\Schemas;

use Filament\Schemas\Schema;

// 1. Layout dari SCHEMAS
use Filament\Schemas\Components\Section;

// 2. Input dari FORMS
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Gudang')
                    ->description('Masukkan detail lokasi penyimpanan utama.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Gudang')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('code')
                            ->label('Kode Gudang')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
