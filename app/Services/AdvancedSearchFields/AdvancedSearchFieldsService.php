<?php

declare(strict_types=1);

namespace App\Services\AdvancedSearchFields;

use App\Helpers\StringHelper;
use App\Services\AdvancedSearchFields\Handlers\BaseHandler;
use App\Services\GetReference;

class AdvancedSearchFieldsService
{
    public static function generate($model): array
    {
        /** @var BaseHandler $handler */
        $handler = app('App\\Services\\AdvancedSearchFields\\Handlers\\' . StringHelper::convertToClassName(GetReference::reference($model)) . 'Handler');
        
        return $handler->handle();
    }
}
