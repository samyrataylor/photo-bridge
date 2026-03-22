<?php

namespace App\Console\Commands;

use App\iCloudPD\Options\Size;
use App\Models\CloudUser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class DownloadAlbumCommand extends Command
{
    protected $signature = 'album:download {user} {album} {--command-only}';

    public function handle(): void
    {
        $io = new SymfonyStyle($this->input, $this->output);
        $user = CloudUser::where('short_name', $this->argument('user'))->first();

        if (! $user) {
            $io->error('User does not exist');

            return;
        }

        $album = $user->albums()->where('name', $this->argument('album'))->first();

        if (! $album) {
            $io->error('Album does not exist');

            return;
        }

        $command = $user->iCloudPD()
            ->builder()
            ->xmpSidecar()
            ->size(Size::Original)
            ->size(Size::Adjusted)
            ->size(Size::Alternative)
            ->directory($album->downloadPath())
            ->album($album->name)
            ->build();

        if ($this->option('command-only')) {
            $io->writeln($command);

            return;
        }

        $io->error('Not set up to run command');
    }
}
