<?php

declare(strict_types=1);

namespace App\Repositories\ActivationCode;

use App\Repositories\BaseRepositoryInterface;
use App\Models\ActivationCode;

interface ActivationCodeRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
