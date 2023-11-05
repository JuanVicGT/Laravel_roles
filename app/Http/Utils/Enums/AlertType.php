<?php

namespace App\Http\Utils\Enums;

enum AlertType: string
{
    case Error = 'error';
    case Warning = 'warning';
    case Info = 'info';
    case Success = 'success';
}
