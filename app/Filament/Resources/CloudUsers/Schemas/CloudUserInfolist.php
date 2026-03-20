<?php

namespace App\Filament\Resources\CloudUsers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CloudUserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('Id'),

                TextEntry::make('name')
                    ->label('Name')->default('-'),

                TextEntry::make('short_name')
                    ->label('Short Name')->default('-'),

                TextEntry::make('apple_email')
                    ->label('Apple Email')->default('-'),

                TextEntry::make('apple_cookie_path')
                    ->label('Apple Cookie Path')->default('-'),

                TextEntry::make('immich_email')
                    ->label('Immich Email')->default('-'),

                TextEntry::make('immich_api_key')
                    ->label('Immich Api Key')->default('-'),

                TextEntry::make('library_download_path')
                    ->label('Library Download Path')->default('-'),

                TextEntry::make('albums_download_path')
                    ->label('Albums Download Path')->default('-'),

                TextEntry::make('last_successful_login')
                    ->label('Last Successful Login')
                    ->dateTime(),

                TextEntry::make('created_at')
                    ->label('Created Date')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Last Modified Date')
                    ->dateTime(),

                TextEntry::make('fetched_assets')
                    ->label('Fetched Assets')->default('-'),

                TextEntry::make('downloaded_assets')
                    ->label('Downloaded Assets')->default('-'),
            ]);
    }
}
