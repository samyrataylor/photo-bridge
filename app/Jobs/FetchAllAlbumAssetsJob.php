<?php

namespace App\Jobs;

use App\Models\CloudUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchAllAlbumAssetsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CloudUser $user
    ) {}

    public function handle(): void
    {
        foreach ($this->user->albums as $album) {
            FetchAlbumAssetsJob::dispatch($album);
        }
    }
}
