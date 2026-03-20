<?php

namespace App\Console\Commands;

use App\Models\CloudUser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class RefreshAlbumsCommand extends Command
{
    protected $signature = 'albums:refresh {name}';

    public function handle(): void
    {
        $io = new SymfonyStyle($this->input, $this->output);

        $user = CloudUser::where('short_name', $this->argument('name'))->first();

        if (! $user) {
            $io->error($this->argument('name').' not found!');

            return;
        }

        $albums = $user->iCloudPD()->listAlbums();

        foreach ($albums as $album) {
            if (! $user->albums()->where('name', $album)->exists()) {
                $user->albums()->create(['name' => $album]);
            }
        }
    }
}
