<?php

namespace App\Immich;

use App\Models\Album;
use App\Models\CloudUser;
use Illuminate\Support\Facades\Process;

class Immich
{
    public function __construct(
        protected(set) CloudUser $user,
    ) {}

    public function builder(): ImmichBuilder
    {
        return new ImmichBuilder()->user($this->user);
    }

    public function uploadAlbum(Album $album): array
    {
        $process = Process::forever()->run($this->builder()->recursive()->uploadAlbum($album->downloadPath(), $album->name));

        return explode(PHP_EOL, $process->output());
    }

    public function uploadLibrary(): array
    {
        $process = Process::forever()->run($this->builder()->recursive()->upload($this->user->library_download_path));

        return explode(PHP_EOL, $process->output());
    }
}
