<?php

namespace App\Filament\Resources\CloudUsers\Pages;

use App\Filament\Resources\CloudUsers\CloudUserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCloudUser extends ViewRecord
{
    protected static string $resource = CloudUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
