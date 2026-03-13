<?php

namespace App\Observers;

use App\Models\CloudUser;
use Illuminate\Support\Str;

class CloudUserObserver
{
    public function saving(CloudUser $cloudUser): void
    {
        if (empty($cloudUser->short_name)) {
            $cloudUser->short_name = explode(' ', Str::lower($cloudUser->name))[0];
        }
    }
}
