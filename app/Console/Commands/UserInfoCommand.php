<?php

namespace App\Console\Commands;

use App\Models\CloudUser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserInfoCommand extends Command
{
    protected $signature = 'user:info {name} {--json} {--pretty}';

    public function handle(): void
    {
        $io = new SymfonyStyle($this->input, $this->output);
        $user = CloudUser::where('short_name', $this->argument('name'))->first();

        if (! $user) {
            $io->error('User not found');

            return;
        }

        $data = [
            'name' => $user->name,
            'short_name' => $user->short_name,
            'apple_email' => $user->apple_email,
            'apple_password' => $user->apple_password,
            'apple_cookie_path' => $user->apple_cookie_path,
            'immich_email' => $user->immich_email,
            'immich_api_key' => $user->immich_api_key,
        ];

        if ($this->option('json')) {
            $io->writeln(json_encode($data, $this->option('pretty') ? JSON_PRETTY_PRINT : 0));

            return;
        }

        foreach ($data as $key => $value) {
            $io->writeln($key.':'.$value);
        }
    }
}
