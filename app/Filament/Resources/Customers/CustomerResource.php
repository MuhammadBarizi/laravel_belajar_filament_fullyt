<?php

namespace App\Filament\Resources\Customers;

use BackedEnum;
use App\Models\Customer;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use App\Models\CustomerModel;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\CreateCustomer;
use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use UnitEnum;

class CustomerResource extends Resource
{
    protected static ?string $model = CustomerModel::class;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';
    
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user';


    protected static ?string $recordTitleAttribute = 'nama_customer';
    protected static ?string $navigationLabel = 'Kelola     Customer';
    protected static ?string $slug = 'kelola-customer'; // url
    protected static ?string $label = 'Kelola Customer'; 




    public static function form(Schema $schema): Schema
    {
        return CustomerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
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
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }
}
