<?php

namespace App\Jobs;

use App\Models\CloudUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetAlbumsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CloudUser $user,
    ) {}

    public function handle(): void
    {
        $albums = $this->user->iCloudPD()->listAlbums();

        foreach ($albums as $album) {
            $this->user->albums()->where('name', $album)->firstOrCreate(['name' => $album]);
        }
    }
}
