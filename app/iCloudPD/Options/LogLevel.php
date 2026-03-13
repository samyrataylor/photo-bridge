<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum LogLevel: string implements Choice
{
    case Debug = 'debug';
    case Info = 'info';
    case Error = 'error';
}
