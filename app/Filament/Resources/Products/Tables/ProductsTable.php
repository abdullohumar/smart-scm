<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\HtmlString;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->searchable()
                    ->sortable()
                    ->label('SKU'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Produk'),

                Tables\Columns\TextColumn::make('barcode_qr')
                    ->label('QR Code')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$record) return '';
                        $code = $record->barcode ?? $record->sku;
                        return new HtmlString(
                            QrCode::size(40)->generate($code)
                        );
                    }),

                Tables\Columns\TextColumn::make('selling_price')
                    ->money('IDR')
                    ->label('Harga Jual'),

                Tables\Columns\TextColumn::make('minimum_stock')
                    ->label('Min. Stok')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Percobaan namespace alternatif untuk versi Dev
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
