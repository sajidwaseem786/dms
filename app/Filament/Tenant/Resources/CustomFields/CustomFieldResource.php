<?php

namespace App\Filament\Tenant\Resources\CustomFields;

use App\Filament\Tenant\Resources\CustomFields\Pages\CreateCustomField;
use App\Filament\Tenant\Resources\CustomFields\Pages\EditCustomField;
use App\Filament\Tenant\Resources\CustomFields\Pages\ListCustomFields;
use App\Filament\Tenant\Resources\CustomFields\Schemas\CustomFieldForm;
use App\Filament\Tenant\Resources\CustomFields\Tables\CustomFieldsTable;
use App\Models\CustomField;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustomFieldResource extends Resource
{
    protected static ?string $model = CustomField::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    protected static ?string $recordTitleAttribute = 'Custom Field';

    public static function form(Schema $schema): Schema
    {
        return CustomFieldForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomFieldsTable::configure($table);
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
            'index' => ListCustomFields::route('/'),
            'create' => CreateCustomField::route('/create'),
            'edit' => EditCustomField::route('/{record}/edit'),
        ];
    }
}
