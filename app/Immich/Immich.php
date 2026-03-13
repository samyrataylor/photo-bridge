<?php

namespace App\Immich;

use App\Models\CloudUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Immich
{
    protected(set) string $host;

    protected(set) string $port;

    protected(set) bool $secure;

    protected(set) string $apiEndpoint;

    protected(set) string $program;

    protected(set) ?CloudUser $user = null;

    protected(set) bool $recursive = true;

    protected(set) bool $skipHash = false;

    protected(set) bool $includeHidden = false;

    public function __construct(
        ?string $host = null,
        ?string $port = null,
        ?bool $secure = null,
        ?string $apiEndpoint = null,
        ?string $program = null,
    ) {
        $this->host = $host ?? config('immich.host', '127.0.0.1');
        $this->port = $port ?? config('immich.port', 2283);
        $this->secure = $secure ?? config('immich.secure', false);
        $this->apiEndpoint = $apiEndpoint ?? config('immich.api_endpoint', '/api');
        $this->program = $program ?? config('immich.program', 'immich');
        $this->recursive = config('immich.defaults.recursive', true);
        $this->skipHash = config('immich.defaults.skip_hash', false);
        $this->includeHidden = config('immich.defaults.include_hidden', false);
    }

    public function user(CloudUser $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function recursive(bool $value = true): static
    {
        $this->recursive = $value;

        return $this;
    }

    public function skipHash(bool $value = true): static
    {
        $this->skipHash = $value;

        return $this;
    }

    public function includeHidden(bool $value = true): static
    {
        $this->includeHidden = $value;

        return $this;
    }

    public function upload(string $path): string
    {
        return $this->buildUploadCommand($path);
    }

    protected function buildUploadCommand(string $path, array $params = []): string
    {
        $args = ['"'.$path.'"'];

        if ($this->recursive) {
            $args[] = '--recursive';
        }

        if ($this->includeHidden) {
            $args[] = '--include-hidden';
        }

        if ($this->skipHash) {
            $args[] = '--skip-hash';
        }

        return $this->command('upload', array_merge($args, $params));
    }

    protected function command(?string $command = null, array $params = []): string
    {
        $cmd = $this->commandParts();

        if (! empty($command)) {
            $cmd[] = $command;
        }

        if (! empty($params)) {
            $cmd = array_merge($cmd, $params);
        }

        return implode(' ', $cmd);
    }

    protected function commandParts(): array
    {
        $parts = [
            $this->program,
            '--url '.$this->url(),
        ];

        $key = $this->key();

        if (! empty($key)) {
            $parts[] = '--key '.$key;
        }

        return $parts;
    }

    public function url(): string
    {
        return implode([
            $this->secure ? 'https://' : 'http://',
            $this->host,
            ':',
            $this->port,
            Str::start($this->apiEndpoint, '/'),
        ]);
    }

    public function key(): ?string
    {
        return $this->user?->immich_api_key;
    }

    public function uploadAlbum(string $path, ?string $albumName = null): string
    {
        $albumName ??= Arr::last(explode(DIRECTORY_SEPARATOR, $path));

        return $this->buildUploadCommand($path, [
            '--album-name "'.$albumName.'"',
        ]);
    }

    public function serverInfo(): string
    {
        return $this->command('server-info');
    }
}
