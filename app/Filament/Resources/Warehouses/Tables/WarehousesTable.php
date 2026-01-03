<?php

namespace App\Filament\Resources\Warehouses\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;       // Import Action
use Filament\Actions\DeleteAction;     // Import Action
use Filament\Actions\BulkActionGroup;  // Import Action
use Filament\Actions\DeleteBulkAction; // Import Action

class WarehousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Gudang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // HAPUS prefix 'Tables\' disini juga
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
