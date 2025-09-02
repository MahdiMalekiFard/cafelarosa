<?php

declare(strict_types=1);

namespace App\Repositories\ArtGallery;

use App\Repositories\BaseRepositoryInterface;
use App\Models\ArtGallery;

interface ArtGalleryRepositoryInterface extends BaseRepositoryInterface
{

    public function extra(array $payload = []): array;

}
