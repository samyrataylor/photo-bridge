<?php

namespace App\Jobs;

use App\Actions\iCloudPD\FetchAssets;
use App\Models\CloudUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchLibraryAssetsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CloudUser $user,
    ) {}

    public function handle(): void
    {
        new FetchAssets()->library($this->user);
    }
}
