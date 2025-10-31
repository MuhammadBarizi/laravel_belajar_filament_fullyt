<?php

namespace App\Filament\Resources\Fakturs;

use BackedEnum;
use App\Models\Faktur;
use Filament\Tables\Table;
use App\Models\FakturModel;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Fakturs\Pages\EditFaktur;
use App\Filament\Resources\Fakturs\Pages\ListFakturs;
use App\Filament\Resources\Fakturs\Pages\CreateFaktur;
use App\Filament\Resources\Fakturs\Schemas\FakturForm;
use App\Filament\Resources\Fakturs\Tables\FaktursTable;
use UnitEnum;

class FakturResource extends Resource
{
    protected static ?string $model = FakturModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

       protected static string | UnitEnum | null $navigationGroup = 'Faktur';
      protected static ?string $recordTitleAttribute = 'Nama_Penjualan';
    protected static ?string $navigationLabel = 'Faktur';
    protected static ?string $slug = 'kelola_faktur'; // url
    protected static ?string $label = 'Kelola Faktur'; 


    public static function form(Schema $schema): Schema
    {
        return FakturForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FaktursTable::configure($table);
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
            'index' => ListFakturs::route('/'),
            'create' => CreateFaktur::route('/create'),
            'edit' => EditFaktur::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
