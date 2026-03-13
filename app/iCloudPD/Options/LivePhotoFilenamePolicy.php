<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum LivePhotoFilenamePolicy: string implements Choice
{
    case Suffix = 'suffix';
    case Original = 'original';
}
