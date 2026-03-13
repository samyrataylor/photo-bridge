<?php

namespace App\iCloudPD\Options;

class PasswordProviderList extends BaseChoiceList
{
    public static function getChoiceClass(): string
    {
        return PasswordProvider::class;
    }
}
