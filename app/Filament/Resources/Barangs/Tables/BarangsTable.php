<?php

namespace App\Filament\Resources\Barangs\Tables;

use Filament\Tables\Table;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class BarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_barang')->label('Nama Barang'),
                TextColumn::make('kode_barang')->label('Kode Barang'),
                TextColumn::make('harga_barang')->label('Harga Barang'),
                //
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                // Excel export button for the table (uses pxlrbt/filament-excel)
                ExportAction::make()->exports([
                    \pxlrbt\FilamentExcel\Exports\ExcelExport::make()->fromTable(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    // Excel export (uses pxlrbt/filament-excel)
                    ExportBulkAction::make(),
                    // PDF export (opens a download route with selected ids)
                    BulkAction::make('export_pdf')
                        ->label('Export PDF')
                        ->url(fn (Collection $records): string => route('exports.barang.pdf', ['ids' => $records->pluck('id')->join(',')]))
                        ->openUrlInNewTab(),
                ]),
            ]);
    }
}
