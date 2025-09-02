<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Pipelines\Auth\AuthDTO;
use App\Pipelines\Auth\Register\SendConfirmationNotificationPipe;
use App\Pipelines\Auth\Shared\CheckUserExistOrNotPipe;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class SendForgotPasswordCodeAction
{
    use AsAction;

    public function __construct() {}

    /** SendForgotPasswordCode .... */
    public function handle(array $payload = []): AuthDTO
    {
        return DB::transaction(function () use ($payload) {
            $dto = new AuthDTO($payload);

            return app(Pipeline::class)
                ->send($dto)
                ->through([
                    CheckUserExistOrNotPipe::class,
                    SendConfirmationNotificationPipe::class,
                ])
                ->then(function (AuthDTO $dto) {
                    return $dto;
                });
        });
    }
}
