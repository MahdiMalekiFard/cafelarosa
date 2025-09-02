<?php

declare(strict_types=1);

namespace App\Repositories\Menu;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Menu;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
