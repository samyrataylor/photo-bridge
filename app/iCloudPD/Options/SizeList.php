<?php

namespace App\iCloudPD\Options;

class SizeList extends BaseChoiceList
{
    public static function getChoiceClass(): string
    {
        return Size::class;
    }
}
