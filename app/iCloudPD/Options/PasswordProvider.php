<?php

namespace App\iCloudPD\Options;

use App\Contracts\Choice;

enum PasswordProvider: string implements Choice
{
    case Console = 'console';
    case Keyring = 'keyring';
    case Parameter = 'parameter';
    case WebUI = 'webui';
}
