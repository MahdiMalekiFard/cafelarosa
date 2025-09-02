<?php

declare(strict_types=1);

namespace App\Helpers;

class NotificationChannelHelper
{
    public static function getNotificationChannels(string $class): array
    {
        return ['database'];
    }
}
