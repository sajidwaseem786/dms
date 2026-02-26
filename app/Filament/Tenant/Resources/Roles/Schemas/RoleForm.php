<?php

namespace App\Filament\Tenant\Resources\Roles\Schemas;

use App\Models\CustomField;
use App\Models\EventRole;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->nullable(),
                Section::make('Custom Fields')
                    ->schema(static::getCustomFieldsSchema())
                    ->collapsible(),
            ]);
    }
    public static function getCustomFieldsSchema(): array
    {
        return CustomField::where('entity_type', EventRole::class)
            ->where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->map(fn(CustomField $field) => static::mapField($field))
            ->toArray();
    }
    protected static function mapField(CustomField $field)
    {
        $name = "customFields.{$field->id}";

        return match ($field->type) {

            'text' => TextInput::make($name)
                ->label($field->name)
                ->required($field->is_required),

            'textarea' => Textarea::make($name)
                ->label($field->name),

            'number' => TextInput::make($name)
                ->numeric()
                ->label($field->name),

            'select' => Select::make($name)
                ->label($field->name)
                ->options($field->options ?? []),

            'radio' => Radio::make($name)
                ->label($field->name)
                ->options($field->options ?? []),

            'checkbox' => CheckboxList::make($name)
                ->label($field->name)
                ->options($field->options ?? []),

            'toggle' => Toggle::make($name)
                ->label($field->name),

            'date' => DatePicker::make($name)
                ->label($field->name),

            'datetime' => DateTimePicker::make($name)
                ->label($field->name),

            'file' => FileUpload::make($name)
                ->disk('public')
                ->directory('custom-fields')
                ->label($field->name),
            'multiselect' => Select::make($name)
                ->label($field->name)
                ->options($field->options ?? [])
                ->multiple(),

            default => TextInput::make($name)
                ->label($field->name),
        };
    }
}
