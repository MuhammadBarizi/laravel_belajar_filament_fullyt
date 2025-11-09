<?php

namespace App\Filament\Resources\Fakturs\Tables;

use Filament\Tables\Table;
use App\Models\FakturModel;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class FaktursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('kode_faktur')->label('Kode Faktur'),
                TextColumn::make('tanggal_faktur'),
                TextColumn::make('kode_customer'),
                TextColumn::make('customer.nama_customer')->label('Nama Customer'),
                TextColumn::make('ket_faktur'),
                TextColumn::make('total')
                ->formatStateUsing(fn (FakturModel $record): string => 'Rp ' . number_format($record->total, 0, ',', '.')),
                
                TextColumn::make('nominal_charge'), 
                TextColumn::make('charge'), 
                TextColumn::make('total_final'), 
            ])
           
            ->filters([
                TrashedFilter::make(),
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
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ExportBulkAction::make(),
                    BulkAction::make('export_pdf')
                        ->label('Export PDF')
                        ->url(fn (Collection $records): string => route('exports.faktur.pdf', ['ids' => $records->pluck('id')->join(',')]))
                        ->openUrlInNewTab(),
                ]),
            ]);
    }
}
