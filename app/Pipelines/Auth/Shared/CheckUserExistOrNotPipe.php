<?php

declare(strict_types=1);

namespace App\Pipelines\Auth\Shared;

use App\Models\User;
use App\Pipelines\Auth\AuthDTO;
use App\Pipelines\Auth\AuthInterface;
use App\Repositories\User\UserRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

readonly class CheckUserExistOrNotPipe implements AuthInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(AuthDTO $dto, Closure $next): AuthDTO
    {
        /** @var User|null $user */
        $user = null;

        if ($email = $dto->getFromPayload('email')) {
            $user = $this->userRepository->find($email, 'email');
        } elseif ($mobile = $dto->getFromPayload('mobile')) {
            $user = $this->userRepository->find($mobile, 'mobile');
        } elseif (auth()->check()) {
            $user = auth()->user();
        }

        // Verify the password
        $password = $dto->getFromPayload('password');
        if (!$password || !Hash::check($password, $user->password)) {
            throw new RuntimeException('Invalid credentials.');
        }

        $dto->setUser($user);

        return $next($dto);
    }
}
