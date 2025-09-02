<?php

declare(strict_types=1);

namespace App\Pipelines\Auth\Shared;

use App\Helpers\ErrorHelper;
use App\Pipelines\Auth\AuthDTO;
use App\Pipelines\Auth\AuthInterface;
use App\Repositories\User\UserRepositoryInterface;
use Closure;

readonly class GenerateToken implements AuthInterface
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function handle(AuthDTO $dto, Closure $next): AuthDTO
    {
        $user = $dto->getUser();
        if ( ! $user) {
            $key = $dto->userRequestWithEmailOrMobile();
            ErrorHelper::ValidationError([
                [$key => trans('validation.exists', ['attribute' => $key])],
            ]);
        }

        $token = $this->userRepository->generateToken($user);
        $dto->setToken($token);

        return $next($dto);
    }
}
