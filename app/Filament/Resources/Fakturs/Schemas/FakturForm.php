<?php

namespace App\Filament\Resources\Fakturs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class FakturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('kode_faktur')->label('Kode Faktur')->required(),
                DatePicker::make('tanggal_faktur'),
                TextInput::make('kode_customer'),
                Select::make('customer_id')->relationship('customer', 'nama_customer'),
                Repeater::make('detail')->relationship()->schema([
                    Select::make('barang_id')->relationship('barang', 'nama_barang'),
                    TextInput::make('diskon')->numeric(),
                    TextInput::make('nama_barang'),
                    TextInput::make('harga')->numeric(),
                    TextInput::make('qty')->numeric(),
                    TextInput::make('hasil_qty')->numeric(),

                    
                    
                ])->label('Detail Items')->minItems(1)->required(), 
                TextInput::make('ket_faktur'),
                TextInput::make('total'),
                TextInput::make('nominal_charge'), 
                TextInput::make('charge'), 
                TextInput::make('total_final'), 
            ]);
    }
}
