<?php

declare(strict_types=1);

namespace App\Repositories\MenuItem;

use App\Repositories\BaseRepositoryInterface;
use App\Models\MenuItem;

interface MenuItemRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
