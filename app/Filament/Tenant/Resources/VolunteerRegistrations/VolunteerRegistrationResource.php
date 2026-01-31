<?php

namespace App\Filament\Tenant\Resources\VolunteerRegistrations;

use App\Filament\Tenant\Resources\VolunteerRegistrations\Pages\CreateVolunteerRegistration;
use App\Filament\Tenant\Resources\VolunteerRegistrations\Pages\EditVolunteerRegistration;
use App\Filament\Tenant\Resources\VolunteerRegistrations\Pages\ListVolunteerRegistrations;
use App\Filament\Tenant\Resources\VolunteerRegistrations\Schemas\VolunteerRegistrationForm;
use App\Filament\Tenant\Resources\VolunteerRegistrations\Tables\VolunteerRegistrationsTable;
use App\Models\VolunteerRegistration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VolunteerRegistrationResource extends Resource
{
    protected static ?string $model = VolunteerRegistration::class;
    protected static string|BackedEnum|null $navigationIcon =
    Heroicon::ClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'Registrations';

    protected static ?string $modelLabel = 'Registration';

    protected static ?string $pluralModelLabel = 'Registrations';
    protected static ?string $recordTitleAttribute = 'VolunteerRegistration';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return VolunteerRegistrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VolunteerRegistrationsTable::configure($table);
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
            'index' => ListVolunteerRegistrations::route('/'),
            'create' => CreateVolunteerRegistration::route('/create'),
            'edit' => EditVolunteerRegistration::route('/{record}/edit'),
        ];
    }
}
