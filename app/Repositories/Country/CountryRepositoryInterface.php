<?php

declare(strict_types=1);

namespace App\Repositories\Country;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Country;

interface CountryRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
