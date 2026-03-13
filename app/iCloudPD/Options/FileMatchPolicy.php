<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum FileMatchPolicy: string implements Choice
{
    case NameSizeDedupWithSuffix = 'name-size-dedup-with-suffix';
    case NameID7 = 'name-id7';
}
