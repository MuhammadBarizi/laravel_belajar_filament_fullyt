<?php

namespace App\Filament\Resources\Fakturs\Schemas;

use App\Models\Barang;
use Filament\Schemas\Schema;
use App\Models\CustomerModel;
use Livewire\Attributes\Reactive;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class FakturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('kode_faktur')->label('Kode Faktur')->required() ->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
                DatePicker::make('tanggal_faktur')->label('Tanggal Faktur')->required()->default(now())->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
               
                Select::make('customer_id')->reactive()->relationship('customer', 'nama_customer')->label('Customer')->required()
                ->afterStateUpdated(function (callable $set, $state) {
                   $customer = CustomerModel::find($state);

                    if($customer){
                        $set('kode_customer', $customer->kode_customer);
                    }
                })->afterStateHydrated(function (callable $set, $state) {
                   $customer = CustomerModel::find($state);

                    if($customer){
                        $set('kode_customer', $customer->kode_customer);
                    }
                })->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]), 
                 TextInput::make('kode_customer')->reactive()->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),

                Repeater::make('detail')->relationship()->schema([
                                        Select::make('barang_id')->relationship('barang', 'nama_barang')->reactive()->afterStateUpdated(function (callable $set, $state) {
                                            $barang = Barang::find($state);
                                            if ($barang) {
                                                    // store the actual price in the detail item's `harga` field (DB column)
                                                    $set('harga', $barang->harga_barang);
                                                    $set('nama_barang', $barang->nama_barang);
                                            }
                                        }),
                   
                    TextInput::make('nama_barang')
                    // ->disabled()
                    ->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
                    TextInput::make('harga')->numeric()->prefix('Rp ')

                    ->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
                   
                          TextInput::make('qty')->numeric()->columnSpan(2)->reactive()->numeric()->afterStateUpdated(function (callable $set, $state, $get) {
                              $tampungHarga = $get('harga');
                              $set('hasil_qty', intval($state * $tampungHarga));
                          }),
                    TextInput::make('hasil_qty')->numeric()->columnSpan(2)->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),

                     TextInput::make('diskon')->numeric()->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ])
                    ->reactive()->afterStateUpdated(function (callable $set, $state, $get) {
                      $hasilQTY = $get('hasil_qty');
                      $diskon = $hasilQTY * ($state / 100);
                      $hasil = $hasilQTY - $diskon;

                      $set('subtotal', intval($hasil));

                    }),
                     TextInput::make('subtotal')->numeric()->columnSpan(2)->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
                ]),
                TextInput::make('ket_faktur')->columnSpan(2),
                TextInput::make('total')->columnSpan(2)->placeholder(function (Set $set, Get $get) {
                    $details = collect($get('detail'))->pluck('subtotal')->sum();
                    if($details == null) {
                        $set('total', 0);

                    } else {
                        $set('total', $details);
                    }
                    
                })->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
                TextInput::make('nominal_charge')->columnSpan(2)->reactive()->afterStateUpdated(function (callable $set, $state, $get) {
                    $total = $get('total');
                    $charge = $total * ($state / 100);  
                    $hasil = $total + $charge;

                    $set('total_final', intval($hasil));
                    $set('charge', intval($charge));

                    
                })->columnSpan([
                        'default' => 2,
                        'md' => 1,
                        'lg' => 1,
                        'xl' => 1,
                    ]),
                TextInput::make('charge')->columnSpan(2)
                // ->disabled()
                ->columnSpan(2),
                TextInput::make('total_final')->columnSpan(2), 
            ]);
    }
}
