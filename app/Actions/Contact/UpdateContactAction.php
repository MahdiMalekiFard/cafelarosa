<?php

namespace App\Actions\Contact;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Contact;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateContactAction
{
    use AsAction;

    public function __construct(
        private readonly ContactRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Contact                                          $contact
     * @param array{title:string,description:string}             $payload
     * @return Contact
     */
    public function handle(Contact $contact, array $payload): Contact
    {
        return DB::transaction(function () use ($contact, $payload) {
            $this->repository->update($contact, $payload);
            $this->syncTranslationAction->handle($contact, Arr::only($payload, ['title', 'description', 'body']));

            return $contact->refresh();
        });
    }
}
