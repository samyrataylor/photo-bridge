<?php

namespace App\Filament\Resources\CloudUsers\Pages;

use App\Filament\Resources\CloudUsers\CloudUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCloudUsers extends ListRecords
{
    protected static string $resource = CloudUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
