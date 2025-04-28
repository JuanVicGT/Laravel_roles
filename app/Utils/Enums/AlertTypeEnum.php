<?php

namespace App\Utils\Enums;

use App\Utils\Traits\EnumToArray;

enum AlertTypeEnum: string
{
    use EnumToArray;

    case Default = '';
    case Error = 'error';
    case Warning = 'warning';
    case Info = 'info';
    case Success = 'success';
}
