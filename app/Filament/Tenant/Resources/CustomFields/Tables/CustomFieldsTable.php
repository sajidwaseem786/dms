<?php

namespace App\Filament\Tenant\Resources\CustomFields\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CustomFieldsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('key')->searchable()->sortable(),
                TextColumn::make('type')->searchable()->sortable(),
                TextColumn::make('entity_type')->searchable()->sortable(),
                IconColumn::make('is_required')
                    ->boolean()
                    ->label('Required')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')->options([
                    'text' => 'Text',
                    'textarea' => 'Textarea',
                    'number' => 'Number',
                    'select' => 'Select',
                    'multiselect' => 'Multi Select',
                    'radio' => 'Radio',
                    'checkbox' => 'Checkbox',
                    'toggle' => 'Toggle',
                    'date' => 'Date',
                    'datetime' => 'DateTime',
                    'file' => 'File Upload',
                    'email' => 'Email',
                    'url' => 'URL',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
