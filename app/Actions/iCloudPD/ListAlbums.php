<?php

namespace App\Actions\iCloudPD;

use App\iCloudPD\Builder;
use Illuminate\Support\Facades\Process;

class ListAlbums
{
    public function run(): string
    {
        $builder = new Builder()->username('')->listAlbums();

        return Process::run($builder->build(), fn (string $type, string $output) => dump($output))->output();
    }
}
