<?php

namespace App\Filament\Resources\Penjualans;

use BackedEnum;
use App\Models\Penjualan;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\PenjualanModel;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Penjualans\Pages\EditPenjualan;
use App\Filament\Resources\Penjualans\Pages\ListPenjualans;
use App\Filament\Resources\Penjualans\Pages\CreatePenjualan;
use App\Filament\Resources\Penjualans\Schemas\PenjualanForm;
use App\Filament\Resources\Penjualans\Tables\PenjualansTable;
use UnitEnum;

class PenjualanResource extends Resource
{
    protected static ?string $model = PenjualanModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static ?string $recordTitleAttribute = 'Nama_Penjualan';
    protected static ?string $navigationLabel = 'Laporan Penjualan';
    protected static ?string $slug = 'laporan-penjualan'; // url
    protected static ?string $label = 'Laporan Penjualan'; 
      protected static string | UnitEnum | null $navigationGroup = 'Faktur';

    public static function form(Schema $schema): Schema
    {
        return PenjualanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenjualans::route('/'),
            'create' => CreatePenjualan::route('/create'),
            'edit' => EditPenjualan::route('/{record}/edit'),
        ];
    }
}
