<?php

namespace App\Models;

use App\iCloudPD\iCloudPD;
use App\Observers\CloudUserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Process;

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
    ];

    protected $hidden = [
        'apple_password',
        'immich_api_key',
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

    public function running()
    {
        $p = Process::forever()->start($this->iCloudPD()->builder()->directory(__DIR__)->dryRun()->build());

        dump($p, $p->id());

        $s = serialize($p);
        dump($s);
        usleep(100000);

        $newp = unserialize($s);

        dump($newp);

        dump($newp == $p);

        dump($newp->latestOutput());
    }
}
