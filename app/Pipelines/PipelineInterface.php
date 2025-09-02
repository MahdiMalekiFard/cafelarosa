<?php

declare(strict_types=1);

namespace App\Pipelines;

use Closure;

interface PipelineInterface
{
    public function handle(array $payload, Closure $next): array;
}
