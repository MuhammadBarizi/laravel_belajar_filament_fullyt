<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama_customer')->label('Nama')->required()->placeholder('Masukkan Nama Customer'),
                TextInput::make('kode_customer')->required()->label('Kode')->numeric(),
                TextInput::make('alamat_customer')->required()->label('Alamat'),
                TextInput::make('telepon_customer')->required()->label('Telepon')->numeric()
                //
            ]);
    }
}
