<?php

namespace App\Filament\Resources\CloudUsers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CloudUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),

                TextInput::make('short_name')
                    ->label('Short Name'),

                TextInput::make('apple_email')
                    ->label('Apple Email')
                    ->required(),

                TextInput::make('apple_password')
                    ->label('Apple Password'),

                TextInput::make('apple_cookie_path')
                    ->label('Apple Cookie Path'),

                TextInput::make('immich_email')
                    ->label('Immich Email'),

                TextInput::make('immich_api_key')
                    ->label('Immich Api Key'),

                TextInput::make('library_download_path')
                    ->label('Library Download Path'),

                TextInput::make('albums_download_path')
                    ->label('Albums Download Path'),

                TextEntry::make('last_successful_login')
                    ->label('Last Successful Login')
                    ->default('-'),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->dateTime(),

                TextEntry::make('fetched_assets')
                    ->label('Fetched Assets')
                    ->default('-'),

                TextEntry::make('downloaded_assets')
                    ->label('Downloaded Assets')
                    ->default('-'),
            ]);
    }
}
