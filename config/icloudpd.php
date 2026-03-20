<?php

use App\iCloudPD\Options\AlignRaw;
use App\iCloudPD\Options\Domain;
use App\iCloudPD\Options\FileMatchPolicy;
use App\iCloudPD\Options\LivePhotoFilenamePolicy;
use App\iCloudPD\Options\LogLevel;
use App\iCloudPD\Options\MFAProvider;

return [
    'allow_destructive_actions' => env('ALLOW_DESTRUCTIVE_ACTIONS', false),

    'install_path' => null,

    'name' => 'icloudpd',

    'defaults' => [
        'cookieDirectory' => '~/.pyicloud',
        'library' => 'PrimarySync',
        'folderStructure' => '{:%Y/%m/%d}',
        'smtpHost' => 'smtp.gmail.com',
        'smtpPort' => 587,
        'livePhotoMovFilenamePolicy' => LivePhotoFilenamePolicy::Suffix,
        'alignRaw' => AlignRaw::AsIs,
        'fileMatchPolicy' => FileMatchPolicy::NameSizeDedupWithSuffix,
        'logLevel' => LogLevel::Debug,
        'domain' => Domain::Com,
        'mfaProvider' => MFAProvider::Console,
    ],

    'exclude_albums' => [
        'Recently Deleted',
        'Live',
        'Videos',
        'Bursts',
    ],
];
