<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum Size: string implements Choice
{
    case Original = 'original';
    case Medium = 'medium';
    case Thumb = 'thumb';
    case Adjusted = 'adjusted';
    case Alternative = 'alternative';

}
