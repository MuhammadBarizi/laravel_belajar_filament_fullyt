<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //  
                TextColumn::make('tanggal')->label('Tanggal')
                ->searchable()
                ->sortable()
                ->date('D F Y'),
                TextColumn::make('kode')->label('Kode Faktur')
                ->searchable()
                ->sortable(),
                TextColumn::make('jumlah')->label('Jumlah')
                ->searchable()
                ->sortable(),
                TextColumn::make('customer.nama_customer')->label('Customer')
                ->searchable()
                ->sortable(),
                TextColumn::make('status')->label('Status')
                ->searchable()
                ->sortable()
                ->badge(),
                TextColumn::make('jenis')->label('Jenis')
                ->searchable()
                ->sortable()
                ->badge(),
            
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
