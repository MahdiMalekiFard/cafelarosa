<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function verifyUser(User $user): User
    {
        $user->mobile_verify_at = now()->toString();
        $user->save();

        return $user;
    }

    public function generateToken(User $user): string
    {
        return $user->createToken('token')->accessToken;
    }
}
