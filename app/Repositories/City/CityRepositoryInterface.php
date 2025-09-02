<?php

declare(strict_types=1);

namespace App\Repositories\City;

use App\Repositories\BaseRepositoryInterface;
use App\Models\City;

interface CityRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
