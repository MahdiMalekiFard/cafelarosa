<?php

declare(strict_types=1);

namespace App\Repositories\Contact;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Contact;

interface ContactRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
