<?php

namespace App\Models;

use App\iCloudPD\iCloudPD;
use App\Immich\Immich;
use App\Observers\CloudUserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([CloudUserObserver::class])]
class CloudUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'apple_email',
        'apple_password',
        'apple_cookie_path',
        'immich_email',
        'immich_api_key',
        'library_download_path',
        'albums_download_path',
        'fetched_assets',
        'downloaded_assets',
        'exclude_albums',
    ];

    protected $hidden = [
        'apple_password',
    ];

    public function applePassword(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => empty($value) ? null : decrypt($value),
            set: fn (?string $value) => empty($value) ? null : encrypt($value),
        );
    }

    public function immichApiKey(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => empty($value) ? null : decrypt($value),
            set: fn (?string $value) => empty($value) ? null : encrypt($value),
        );
    }

    protected function casts(): array
    {
        return [
            'last_successful_login' => 'timestamp',
            'exclude_albums' => 'array',
        ];
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function iCloudPD(): iCloudPD
    {
        return new iCloudPD($this);
    }

    public function immich(): Immich
    {
        return new Immich($this);
    }
}
