<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Models\PenjualanModel;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
                ->badge()
                // make the resolver tolerant to unexpected types/values by removing the strict
                // string type hint and adding a default arm to the match expression
                ->color(fn ($state): string => match ($state) {
                    'draft' => 'gray',
                    'reviewing' => 'warning',
                    'published' => 'success',
                    'rejected' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (PenjualanModel $record): string => $record->status == 0 ? 'Belum Lunas' : 'Lunas')
              
            
            ])
             ->emptyStateHeading('Tidak ada data laporan.')
              ->emptyStateDescription('Silahkan buat faktur terlebih dahulu.')
               ->emptyStateIcon('heroicon-o-presentation-chart-bar')
               ->emptyStateActions([
            Action::make('create')
                ->label('Buat Faktur')
                // point to the Faktur resource index route (use the resource slug as registered)
                ->url(route('filament.admin.resources.kelola_faktur.create'))
                ->icon('heroicon-m-plus')
                ->button(),
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
                    ExportBulkAction::make(),
                    BulkAction::make('export_pdf')
                        ->label('Export PDF')
                        ->url(fn (Collection $records): string => route('exports.penjualan.pdf', ['ids' => $records->pluck('id')->join(',')]))
                        ->openUrlInNewTab(),
                ]),
            ]);
    }
}
