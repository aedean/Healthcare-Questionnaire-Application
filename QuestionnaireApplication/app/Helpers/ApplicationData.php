<?php

use App\SystemConfig;

function getApplicationName()
{
    $name = SystemConfig::where('attributename', '=', 'Application Name')->first();
    $name = $name->attributevalue;
    return $name;
}

function getApplicationLogo()
{
    $logo = SystemConfig::where('attributename', '=', 'Application Logo')->first();
    $logo = $logo->attributevalue;
    return $logo;
}
