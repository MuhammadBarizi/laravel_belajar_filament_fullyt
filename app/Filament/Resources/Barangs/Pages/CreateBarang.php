<?php

namespace App\Filament\Resources\Barangs\Pages;

use App\Filament\Resources\Barangs\BarangResource;
use Filament\Resources\Pages\CreateRecord;
 use Filament\Notifications\Notification;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;
   

protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Data Barang Ditambahkan')
        ->icon('heroicon-o-check-circle')
        ->iconColor('warning')
        ->duration(2000)
        ->body('Data Barang telah berhasil ditambahkan.');
}
}
