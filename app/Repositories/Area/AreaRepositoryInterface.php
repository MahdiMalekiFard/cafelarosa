<?php

declare(strict_types=1);

namespace App\Repositories\Area;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Area;

interface AreaRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
