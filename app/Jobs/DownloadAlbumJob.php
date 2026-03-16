<?php

namespace App\Jobs;

use App\Models\Album;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadAlbumJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Album $album
    ) {}

    public function handle(): void
    {
        if ($this->album->download && $this->album->downloaded_assets !== $this->album->fetched_assets) {
            $assets = $this->album->iCloudPD()->downloadAlbum($this->album);
            $this->album->update(['downloaded_assets' => $assets, 'fetched_assets' => $assets]);
        }
    }
}
