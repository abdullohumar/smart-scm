<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema; // GANTI: Gunakan Schema
use Filament\Forms; // Kita tetap butuh ini untuk Components (TextInput, etc)

class ProductForm
{
    // GANTI: Parameter $schema, return type Schema
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ // GANTI: method 'schema()' biasanya jadi 'components()' di base Schema
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Produk')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('sku')
                                    ->label('SKU (Auto)')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->visible(fn ($record) => $record !== null),
                                Forms\Components\TextInput::make('barcode')
                                    ->label('Barcode/QR Value')
                                    ->unique(ignoreRecord: true),
                                Forms\Components\Textarea::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Harga & Stok')
                            ->schema([
                                Forms\Components\TextInput::make('purchase_price')
                                    ->label('Harga Beli')
                                    ->numeric()
                                    ->prefix('Rp'),
                                Forms\Components\TextInput::make('selling_price')
                                    ->label('Harga Jual')
                                    ->numeric()
                                    ->prefix('Rp'),
                                Forms\Components\TextInput::make('minimum_stock')
                                    ->label('Min. Stok (Alert)')
                                    ->numeric()
                                    ->default(10),
                                Forms\Components\TextInput::make('unit')
                                    ->label('Satuan')
                                    ->default('pcs'),
                            ])->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true),
                                Forms\Components\Toggle::make('has_variants')
                                    ->label('Punya Varian?'),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }
}
