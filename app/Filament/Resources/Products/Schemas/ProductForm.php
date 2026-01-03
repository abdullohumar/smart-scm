<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;

// 1. Ambil Layout dari SCHEMAS
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

// 2. Ambil Input dari FORMS
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Produk')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('sku')
                                    ->label('SKU (Auto)')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->visible(fn ($record) => $record !== null),
                                TextInput::make('barcode')
                                    ->label('Barcode/QR Value')
                                    ->unique(ignoreRecord: true),
                                Textarea::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Section::make('Harga & Stok')
                            ->schema([
                                TextInput::make('purchase_price')
                                    ->label('Harga Beli')
                                    ->numeric()
                                    ->prefix('Rp'),
                                TextInput::make('selling_price')
                                    ->label('Harga Jual')
                                    ->numeric()
                                    ->prefix('Rp'),
                                TextInput::make('minimum_stock')
                                    ->label('Min. Stok (Alert)')
                                    ->numeric()
                                    ->default(10),
                                TextInput::make('unit')
                                    ->label('Satuan')
                                    ->default('pcs'),
                            ])->columns(2),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Status')
                            ->schema([
                                Toggle::make('is_active')
                                    ->default(true),
                                Toggle::make('has_variants')
                                    ->label('Punya Varian?'),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }
}
