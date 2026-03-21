<?php

namespace App\Console\Commands;

use App\Actions\iCloudPD\FetchAssets;
use App\Models\CloudUser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class AlbumAssetCountCommand extends Command
{
    protected $signature = 'album:asset-count {name} {album} {--json} {--fetch} {--clear} {--downloaded=} {--fetched=} {--imported=}';

    public function handle(): void
    {
        $fetched = $this->option('fetched');
        $imported = $this->option('imported');
        $downloaded = $this->option('downloaded');

        $io = new SymfonyStyle($this->input, $this->output);

        $user = CloudUser::where('short_name', $this->argument('name'))->first();

        if (! $user) {
            $io->error('User not found!');

            return;
        }

        $album = $user->albums()->where('name', $this->argument('album'))->first();

        if (! $album) {
            $io->error('Album not found!');

            return;
        }

        if ($this->option('clear')) {
            $album->update([
                'fetched_assets' => null,
                'imported_assets' => null,
                'downloaded_assets' => null,
            ]);
            $album->refresh();
        }

        if ($this->option('fetch')) {
            new FetchAssets()->album($album);
            $album->refresh();
        }

        if (is_null($fetched) && is_null($imported) && is_null($downloaded)) {
            $lines = [
                'fetched' => $album->fetched_assets,
                'downloaded' => $album->downloaded_assets,
                'imported' => $album->imported_assets,
            ];

            if ($this->option('json')) {
                $io->writeln(json_encode($lines));

                return;
            }

            foreach ($lines as $key => $value) {
                $io->writeln($key.':'.$value);
            }

            return;
        }

        $data = [];

        if (! is_null($fetched)) {
            $data['fetched_assets'] = $fetched;
        }

        if (! is_null($downloaded)) {
            $data['downloaded_assets'] = $downloaded;
        }

        if (! is_null($imported)) {
            $data['imported_assets'] = $imported;
        }

        if (! empty($data)) {
            $album->update($data);
            $album->refresh();
        }

        $io->success('Updated asset count!');
    }
}
