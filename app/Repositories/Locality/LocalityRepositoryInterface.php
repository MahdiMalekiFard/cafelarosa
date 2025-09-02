<?php

declare(strict_types=1);

namespace App\Repositories\Locality;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Locality;

interface LocalityRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
