<?php

namespace App\Filament\Exports;

use App\Models\FakturModel;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class FakturModelExporter extends Exporter
{
    protected static ?string $model = FakturModel::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('kode_faktur'),
            ExportColumn::make('tanggal_faktur'),
            ExportColumn::make('kode_customer'),
            ExportColumn::make('customer_id'),
            ExportColumn::make('ket_faktur'),
            ExportColumn::make('total'),
            ExportColumn::make('nominal_charge'),
            ExportColumn::make('charge'),
            ExportColumn::make('total_final'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your faktur model export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
