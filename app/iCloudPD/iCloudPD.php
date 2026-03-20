<?php

namespace App\iCloudPD;

use App\Models\Album;
use App\Models\CloudUser;
use Illuminate\Support\Carbon;
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

        $exclude = array_merge(config('icloudpd.exclude_albums', []), $this->user->exclude_albums);

        return collect($output)->filter(function (string $line) use ($exclude) {
            return ! empty($line) && ! preg_match('/^\d{4}-\d{2}-\d{2}/', $line) && $line !== 'Albums:' && ! in_array($line, $exclude);
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

    public function getLibraryAssets(): ?int
    {
        $process = Process::start($this->builder()->directory(__DIR__)->dryRun()->build());

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
        $outfile = $this->logPath('download_album_'.$album->name.'_'.Carbon::now()->format('YmdHis').'.log');

        $command = $this->builder()->directory($album->downloadPath())->album($album->name)->build();

        $process = Process::forever()->run($command, function (string $type, string $line) use ($outfile) {
            file_put_contents($outfile, $line, FILE_APPEND);
        });

        if ($process->successful()) {
            preg_match('/Downloading (\d*) original/', $process->output(), $matches);
            unlink($outfile);

            return (int) $matches[1];
        }

        return null;
    }

    public function downloadLibrary(): ?int
    {
        $outfile = $this->logPath('download_library_'.Carbon::now()->format('YmdHis').'.log');

        $command = $this->builder()->directory($this->user->library_download_path)->build();

        $process = Process::forever()->run($command, function (string $type, string $line) use ($outfile) {
            file_put_contents($outfile, $line, FILE_APPEND);
        });

        if ($process->successful()) {
            preg_match('/Downloading (\d*) original/', $process->output(), $matches);
            unlink($outfile);

            return (int) $matches[1];
        }

        return null;
    }

    protected function logPath(?string $filename = null): string
    {
        $path = storage_path(implode(DIRECTORY_SEPARATOR, [
            'logs',
            'cloudUser',
            $this->user->id,
        ]));

        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return empty($filename) ? $path : $path.DIRECTORY_SEPARATOR.$filename;
    }
}
