<?php

namespace App\Filament\Resources\CloudUsers\Pages;

use App\Filament\Resources\CloudUsers\CloudUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCloudUser extends CreateRecord
{
    protected static string $resource = CloudUserResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
