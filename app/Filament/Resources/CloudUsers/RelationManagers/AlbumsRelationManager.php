<?php

namespace App\Filament\Resources\CloudUsers\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlbumsRelationManager extends RelationManager
{
    protected static string $relationship = 'albums';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cloud_user_id')
                    ->label('Cloud User Id')
                    ->relationship('cloudUser', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('name')
                    ->label('Name')
                    ->required(),

                Checkbox::make('fetch')
                    ->label('Fetch'),

                Checkbox::make('download')
                    ->label('Download'),

                Checkbox::make('import')
                    ->label('Import'),

                TextInput::make('fetched_assets')
                    ->label('Fetched Assets')
                    ->integer(),

                TextInput::make('downloaded_assets')
                    ->label('Downloaded Assets')
                    ->integer(),

                TextInput::make('imported_assets')
                    ->label('Imported Assets')
                    ->integer(),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->dateTime(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cloudUser.name')
                    ->label('Cloud User Id'),

                TextEntry::make('name')
                    ->label('Name'),

                TextEntry::make('fetch')
                    ->label('Fetch'),

                TextEntry::make('download')
                    ->label('Download'),

                TextEntry::make('import')
                    ->label('Import'),

                TextEntry::make('fetched_assets')
                    ->label('Fetched Assets'),

                TextEntry::make('downloaded_assets')
                    ->label('Downloaded Assets'),

                TextEntry::make('imported_assets')
                    ->label('Imported Assets'),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->dateTime(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('fetch')
                    ->boolean()
                    ->label('Fetch'),

                IconColumn::make('download')
                    ->boolean()
                    ->label('Download'),

                IconColumn::make('import')
                    ->boolean()
                    ->label('Import'),

                TextColumn::make('fetched_assets')
                    ->label('Fetched Assets'),

                TextColumn::make('downloaded_assets')
                    ->label('Downloaded Assets'),

                TextColumn::make('imported_assets')
                    ->label('Imported Assets'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
