<?php

namespace App\Jobs;

use App\Models\CloudUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadLibraryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CloudUser $user,
    ) {}

    public function handle(): void
    {
        if ($this->user->downloaded_assets !== $this->user->fetched_assets || empty($this->user->fetched_assets) || empty($this->user->downloaded_assets)) {
            $assets = $this->user->iCloudPD()->downloadLibrary();
            $this->user->update(['downloaded_assets' => $assets, 'fetched_assets' => $assets]);
        }
    }
}
