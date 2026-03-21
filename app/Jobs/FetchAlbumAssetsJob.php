<?php

namespace App\Jobs;

use App\Actions\iCloudPD\FetchAssets;
use App\Models\Album;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchAlbumAssetsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Album $album,
    ) {}

    public function handle(): void
    {
        new FetchAssets()->album($this->album);
    }
}
