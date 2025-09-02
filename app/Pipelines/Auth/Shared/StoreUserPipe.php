<?php

declare(strict_types=1);

namespace App\Pipelines\Auth\Shared;

use App\Actions\User\StoreUserAction;
use App\Pipelines\Auth\AuthDTO;
use App\Pipelines\Auth\AuthInterface;
use Closure;

readonly class StoreUserPipe implements AuthInterface
{
    public function __construct(
        private StoreUserAction $storeUserAction
    ) {}

    public function handle(AuthDTO $dto, Closure $next): AuthDTO
    {
        $user = $dto->getUser();
        if ( ! $user) {
            $user = $this->storeUserAction->handle($dto->getPayload());
            $dto->setUser($user);
        }

        return $next($dto);
    }
}
