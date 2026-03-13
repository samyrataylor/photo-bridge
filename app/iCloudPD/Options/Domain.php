<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum Domain: string implements Choice
{
    case Com = 'com';
    case Cn = 'cn';
}
