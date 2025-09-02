<?php

declare(strict_types=1);

namespace App\Helpers;

class PowerGridHelper
{
    public static function rowActionClass($type = 'secondary'): string
    {
        return 'btn btn-sm text-white bg-' . $type;
    }

    public static function rowActionIcon($name = 'user'): string
    {
        return '<i class="fas fa-' . $name . '"></i>';
    }

    public static function rowActionDeleteIcon($name = 'delete'): string
    {
        return '<i class="fas fa-' . $name . '"></i>';
    }

    public static function rowActionEditIcon($name = 'edit'): string
    {
        return '<i class="fas fa-' . $name . '"></i>';
    }

    public static function rowActionViewIcon($name = 'eye'): string
    {
        return '<i class="fas fa-' . $name . '"></i>';
    }

    public static function rowActionDeleteClass($type = 'light'): string
    {
        return 'btn btn-sm rounded-0 btn-active-danger btn-' . $type;
    }

    public static function dateFormat(): string
    {
        return 'd/m/Y';
    }

    public static function dateTimeFormat(): string
    {
        return 'd/m/Y H:i:s';
    }

    public static function jdateDate($timestamp): string
    {
        return jdate($timestamp)->format('Y/m/d');
    }

    public static function jdateDateTime($timestamp): string
    {
        return jdate($timestamp)->format('Y/m/d h:m');
    }
}
