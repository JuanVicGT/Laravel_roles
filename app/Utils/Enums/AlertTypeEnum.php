<?php

namespace App\Utils\Enums;

use App\Utils\Traits\EnumToArray;

enum AlertTypeEnum: string
{
    use EnumToArray;

    case DEFAULT = '';
    case ERROR = 'error';
    case WARNING = 'warning';
    case INFO = 'info';
    case SUCCESS = 'success';
}
