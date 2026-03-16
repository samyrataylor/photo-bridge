<?php

namespace App\Enums;

enum AlbumAction: string
{
    case Fetch = 'FETCH';
    case Download = 'DOWNLOAD';
    case Import = 'IMPORT';
}
