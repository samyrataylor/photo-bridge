<?php

namespace App\iCloudPD;

use App\Models\Album;
use App\Models\CloudUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Process;

class iCloudPD
{
    public function __construct(
        protected(set) CloudUser $user,
    ) {}

    public function listAlbums(): Collection
    {
        $output = explode(PHP_EOL, Process::run($this->builder()->listAlbums()->build())->output());

        return collect($output)->filter(function (string $line) {
            return ! empty($line) && ! preg_match('/^\d{4}-\d{2}-\d{2}/', $line) && $line !== 'Albums:';
        })->values();
    }

    public function builder(): CommandBuilder
    {
        $builder = new CommandBuilder()->username($this->user->apple_email);

        if (! empty($this->user->apple_password)) {
            $builder->password($this->user->apple_password);
        }

        if (! empty($this->user->apple_cookie_path)) {
            $builder->cookieDirectory($this->user->apple_cookie_path);
        }

        return $builder;
    }

    public function getAlbumAssets(Album $album): ?int
    {
        $process = Process::start($this->builder()->directory(__DIR__)->dryRun()->album($album->name)->build());

        while ($process->running()) {
            if (preg_match('/Downloading (\d*) original/', $process->latestOutput(), $matches)) {
                $process->stop();

                return (int) $matches[1];
            }
        }

        return null;
    }

    public function downloadAlbum(Album $album): ?int
    {
        $output = Process::forever()->run($this->builder()->directory($album->downloadPath())->album($album->name)->build())->output();

        preg_match('/Downloading (\d*) original/', $output, $matches);

        return (int) $matches[1];
    }
}
