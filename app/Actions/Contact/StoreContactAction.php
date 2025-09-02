<?php

namespace App\Actions\Contact;

use App\Models\Contact;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreContactAction
{
    use AsAction;

    public function __construct(
        private readonly ContactRepositoryInterface $repository,
    )
    {
    }

    /**
     * @param array{
     *     name:string,
     *     email:string,
     *     phone:string,
     *     message:string,
     *     } $payload
     * @return Contact
     * @throws Throwable
     */
    public function handle(array $payload): Contact
    {
        return DB::transaction(function () use ($payload) {
            /** @var Contact $model */
            $model = $this->repository->store($payload);

            return $model->refresh();
        });
    }
}
