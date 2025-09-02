<?php

namespace App\Actions\Contact;

use App\Models\Contact;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteContactAction
{
    use AsAction;

    public function __construct(public readonly ContactRepositoryInterface $repository)
    {
    }

    public function handle(Contact $contact): bool
    {
        return DB::transaction(function () use ($contact) {
            return $this->repository->delete($contact);
        });
    }
}
