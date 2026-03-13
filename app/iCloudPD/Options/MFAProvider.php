<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum MFAProvider: string implements Choice
{
    case Console = 'console';
    case WebUI = 'webui';
}
