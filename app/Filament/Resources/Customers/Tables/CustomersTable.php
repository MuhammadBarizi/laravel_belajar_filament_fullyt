<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama_customer')->label('Nama')->searchable()->sortable(),
                TextColumn::make('kode_customer')->label('Kode')->copyable()->copyMessage('Kode copied to clipboard!'),
                TextColumn::make('alamat_customer')->label('Alamat'),
                TextColumn::make('telepon_customer')->label('Telepon'),
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
                    ExportBulkAction::make(),
                    BulkAction::make('export_pdf')
                        ->label('Export PDF')
                        ->url(fn (Collection $records): string => route('exports.customer.pdf', ['ids' => $records->pluck('id')->join(',')]))
                        ->openUrlInNewTab(),
                ]),
            ]);
    }
}
