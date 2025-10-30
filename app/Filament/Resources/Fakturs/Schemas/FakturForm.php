<?php

namespace App\Filament\Resources\Fakturs\Schemas;

use Filament\Schemas\Schema;
use App\Models\CustomerModel;
use Livewire\Attributes\Reactive;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Models\Barang;

class FakturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('kode_faktur')->label('Kode Faktur')->required()->columnSpan(2),
                DatePicker::make('tanggal_faktur'),
               
                Select::make('customer_id')->reactive()->relationship('customer', 'nama_customer')->columnSpan(2)->label('Items')->minItems(1)->required()
                ->afterStateUpdated(function (callable $set, $state) {
                   $customer = CustomerModel::find($state);

                    if($customer){
                        $set('kode_customer', $customer->kode_customer);
                    }
                }), 
                 TextInput::make('kode_customer')->disabled(),

                Repeater::make('detail')->relationship()->schema([
                    Select::make('barang_id')->relationship('barang', 'nama_barang')->reactive()->afterStateUpdated(function (callable $set, $state) {
                      $barang = Barang::find($state);
                      if($barang){
                        $set('harga', $barang->kode_barang);
                        $set('nama_barang', $barang->nama_barang);
                        $set('harga_barang', $barang->harga_barang);
                      }
                      
                    }),
                    TextInput::make('diskon')->numeric()->columnSpan(2),
                    TextInput::make('nama_barang')->columnSpan(2),
                    TextInput::make('harga_barang')->numeric()->columnSpan(2),
                    TextInput::make('qty')->numeric()->columnSpan(2),
                    TextInput::make('hasil_qty')->numeric()->columnSpan(2),

                    
                ]),
                TextInput::make('ket_faktur')->columnSpan(2),
                TextInput::make('total')->columnSpan(2),
                TextInput::make('nominal_charge')->columnSpan(2), 
                TextInput::make('charge')->columnSpan(2), 
                TextInput::make('total_final')->columnSpan(2), 
            ]);
    }
}
