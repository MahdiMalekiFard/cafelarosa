<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Pipelines\Auth\AuthDTO;
use App\Pipelines\Auth\Shared\CheckUserExistOrNotPipe;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Lorisleiva\Actions\Concerns\AsAction;

readonly class LogoutAction
{
    use AsAction;

    public function __construct() {}

    /** Login .... */
    public function handle(array $payload = []): AuthDTO
    {
        return DB::transaction(function () use ($payload) {
            $dto = new AuthDTO($payload);

            return app(Pipeline::class)
                ->send($dto)
                ->through([
                    CheckUserExistOrNotPipe::class,
                ])
                ->then(function (AuthDTO $dto) {
                    $tokens =  $dto->getUser()->tokens->pluck('id');
                    Token::whereIn('id', $tokens)
                        ->update(['revoked' => true]);

                    RefreshToken::whereIn('access_token_id', $tokens)->update(['revoked' => true]);

                    return $dto;
                });
        });
    }
}
