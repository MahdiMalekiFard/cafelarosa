<?php

declare(strict_types=1);

namespace App\Repositories\Profile;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Profile;

interface ProfileRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
