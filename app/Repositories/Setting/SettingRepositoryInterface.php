<?php

declare(strict_types=1);

namespace App\Repositories\Setting;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Setting;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
