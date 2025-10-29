<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_barang'),
                TextInput::make('kode_barang'),
                TextInput::make('harga_barang')->numeric(),
                
                //
            ]);
    }
}
