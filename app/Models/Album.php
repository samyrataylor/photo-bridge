<?php

namespace App\Models;

use App\iCloudPD\iCloudPD;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $fillable = [
        'name',
        'fetch',
        'download',
        'import',
        'fetched_assets',
        'downloaded_assets',
        'imported_assets',
    ];

    public function cloudUser(): BelongsTo
    {
        return $this->belongsTo(CloudUser::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(AlbumAction::class);
    }

    public function downloadPath(): ?string
    {
        return strtr($this->cloudUser->albums_download_path, [
            '{name}' => $this->name,
        ]);
    }

    public function iCloudPD(): iCloudPD
    {
        return $this->cloudUser->iCloudPD();
    }

    protected function casts(): array
    {
        return [
            'fetch' => 'boolean',
            'download' => 'boolean',
            'import' => 'boolean',
        ];
    }
}
