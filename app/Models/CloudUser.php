<?php

namespace App\Models;

use App\Observers\CloudUserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
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
    ];

    protected $hidden = [
        'apple_password',
        'immich_api_key',
    ];

    public function applePassword(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => decrypt($value),
            set: fn (string $value) => encrypt($value),
        );
    }

    public function immichApiKey(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => decrypt($value),
            set: fn (string $value) => encrypt($value),
        );
    }

    protected function casts(): array
    {
        return [
            'last_successful_login' => 'timestamp',
        ];
    }
}
