<?php

namespace App\Contracts;

use App\iCloudPD\Options\AlignRaw;
use App\iCloudPD\Options\Domain;
use App\iCloudPD\Options\FileMatchPolicy;
use App\iCloudPD\Options\LivePhotoFilenamePolicy;
use App\iCloudPD\Options\LivePhotoSize;
use App\iCloudPD\Options\LogLevel;
use App\iCloudPD\Options\MFAProvider;
use App\iCloudPD\Options\PasswordProvider;
use App\iCloudPD\Options\PasswordProviderList;
use App\iCloudPD\Options\Size;
use App\iCloudPD\Options\SizeList;
use Stringable;

interface iCloudPDClient extends Stringable
{
    public function directory(string $directory): static;

    public function authOnly(bool $value = true): static;

    public function cookieDirectory(string $directory): static;

    public function size(Size|SizeList $size, bool $overrideExisting = false): static;

    public function livePhotoSize(LivePhotoSize $size): static;

    public function recent(int $number): static;

    public function untilFound(int $number): static;

    public function album(string|array $albums): static;

    public function listAlbums(bool $value = true): static;

    public function library(string $library): static;

    public function listLibraries(bool $value = true): static;

    public function skipVideos(bool $value = true): static;

    public function skipLivePhotos(bool $value = true): static;

    public function xmpSidecar(bool $value = true): static;

    public function forceSize(bool $value = true): static;

    public function autoDelete(bool $value = true): static;

    public function folderStructure(string $format): static;

    public function setExifDatetime(bool $value = true): static;

    public function smtpUsername(string $username): static;

    public function smtpPassword(string $password): static;

    public function smtpHost(string $host): static;

    public function smtpPort(int $port): static;

    public function smtpNoTLS(bool $value = true): static;

    public function notificationEmail(string $email): static;

    public function notificationEmailFrom(string $email): static;

    public function notificationScript(string $path): static;

    public function keepRecentDays(int $days): static;

    public function dryRun(bool $value = true): static;

    public function keepUnicodeInFilenames(bool $value = true): static;

    public function watchWithInterval(int $seconds): static;

    public function livePhotoFilenamePolicy(LivePhotoFilenamePolicy $policy): static;

    public function alignRaw(AlignRaw $option): static;

    public function fileMatchPolicy(FileMatchPolicy $policy): static;

    public function skipCreatedBefore(string $timestamp): static;

    public function skipCreatedAfter(string $timestamp): static;

    public function skipPhotos(bool $value = true): static;

    public function username(string $username): static;

    public function password(string $password): static;

    public function version(): static;

    public function useOSLocale(bool $value = true): static;

    public function onlyPrintFilenames(bool $value = true): static;

    public function logLevel(LogLevel $level): static;

    public function noProgressBar(bool $value = true): static;

    public function domain(Domain $domain): static;

    public function passwordProvider(
        PasswordProvider|PasswordProviderList $providers,
        bool $overrideExisting = false,
    ): static;

    public function mfaProvider(MFAProvider $provider): static;

    public function reset(): static;

    public function clear(string $property): static;

    public function clearAll(): static;

    public function build(): string;

    public function parameters(): array;
}
