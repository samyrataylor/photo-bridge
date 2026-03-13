<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum LivePhotoSize: string implements Choice
{
    case Original = 'original';
    case Medium = 'medium';
    case Thumb = 'thumb';
}
