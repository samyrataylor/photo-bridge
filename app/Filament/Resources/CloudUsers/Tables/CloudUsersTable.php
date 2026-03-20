<?php

namespace App\Filament\Resources\CloudUsers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CloudUsersTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('short_name')
                    ->label('Short Name'),

                TextColumn::make('apple_email')
                    ->label('Apple Email'),

                TextColumn::make('apple_cookie_path')
                    ->label('Apple Cookie Path'),

                TextColumn::make('immich_email')
                    ->label('Immich Email'),

                TextColumn::make('immich_api_key')
                    ->label('Immich Api Key'),

                TextColumn::make('library_download_path')
                    ->label('Library Download Path'),

                TextColumn::make('albums_download_path')
                    ->label('Albums Download Path'),

                TextColumn::make('last_successful_login')
                    ->label('Last Successful Login')
                    ->date(),

                TextColumn::make('fetched_assets')
                    ->label('Fetched Assets'),

                TextColumn::make('downloaded_assets')
                    ->label('Downloaded Assets'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
