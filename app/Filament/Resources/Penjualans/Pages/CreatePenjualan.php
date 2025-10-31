<?php

namespace App\Filament\Resources\Penjualans\Pages;

use App\Models\PenjualanModel;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Penjualans\PenjualanResource;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    public function afterCreate(): void
    {
        // Custom logic after creating a Penjualan record
       
    }
}
