<?php

namespace App\Filament\Resources\Warehouses\Pages;

use App\Filament\Resources\Warehouses\WarehouseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWarehouse extends CreateRecord
{
    protected static string $resource = WarehouseResource::class;

    // TAMBAHKAN KODE INI
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
