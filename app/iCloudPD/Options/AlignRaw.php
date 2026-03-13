<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum AlignRaw: string implements Choice
{
    case AsIs = 'as-is';
    case Original = 'original';
    case Alternative = 'alternative';
}
