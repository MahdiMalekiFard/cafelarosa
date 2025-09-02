<?php

namespace App\Actions\Profile;

use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateProfileAction
{
    use AsAction;

    public function __construct(
        private readonly ProfileRepositoryInterface $repository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly FileService $fileService
    )
    {
    }


    /**
     * @param Profile                                       $profile
     * @param array{name:string,email:string,mobile:string} $payload
     * @return Profile
     * @throws Throwable
     */
    public function handle(Profile $profile, array $payload): Profile
    {
        return DB::transaction(function () use ($profile, $payload) {
            $user = $profile->user;
            $this->userRepository->update($user, Arr::only($payload, ['name', 'family', 'mobile', 'email']));
            $this->repository->update($profile, $payload);
            $this->fileService->addMedia($profile->user, 'avatar', 'avatar');

            return $profile->refresh();
        });
    }
}
