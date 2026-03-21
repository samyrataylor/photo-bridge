<?php

namespace App\Actions\iCloudPD;

use App\Models\Album;
use App\Models\CloudUser;

class FetchAssets
{
    public function album(Album $album): ?int
    {
        if ($album->fetch) {
            $assets = $album->cloudUser->iCloudPD()->getAlbumAssets($album);
            $album->update(['fetched_assets' => $assets]);
        }

        return $assets ?? null;
    }

    public function library(CloudUser $user): ?int
    {
        $assets = $user->iCloudPD()->getLibraryAssets();
        $user->update(['fetched_assets' => $assets]);

        return $assets ?? null;
    }
}
