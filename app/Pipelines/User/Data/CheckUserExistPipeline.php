<?php

declare(strict_types=1);

namespace App\Pipelines\User\Data;

use App\Pipelines\PipelineInterface;
use Closure;

class CheckUserExistPipeline implements PipelineInterface
{
    public function handle(array $payload, Closure $next): array
    {
        return $next($payload);
    }
}
