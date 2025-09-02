<?php

declare(strict_types=1);

namespace App\Repositories\Province;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Province;

interface ProvinceRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
