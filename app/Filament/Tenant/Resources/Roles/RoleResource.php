<?php

namespace App\Filament\Tenant\Resources\Roles;

use App\Filament\Tenant\Resources\Roles\Pages\CreateRole;
use App\Filament\Tenant\Resources\Roles\Pages\EditRole;
use App\Filament\Tenant\Resources\Roles\Pages\ListRoles;
use App\Filament\Tenant\Resources\Roles\Schemas\RoleForm;
use App\Filament\Tenant\Resources\Roles\Tables\RolesTable;
use App\Models\VolunteerRole;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $model = VolunteerRole::class;

    protected static string|BackedEnum|null $navigationIcon =
    Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'Role';
    protected static string|\UnitEnum|null $navigationGroup = 'Event Configuration';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
