<?php

declare(strict_types=1);

namespace App\Pipelines\Auth\Register;

use App\Models\ActivationCode;
use App\Notifications\SendConfirmationCodeNotification;
use App\Pipelines\Auth\AuthDTO;
use App\Pipelines\Auth\AuthInterface;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use Closure;
use Exception;
use Illuminate\Support\Carbon;
use Random\RandomException;

readonly class SendConfirmationNotificationPipe implements AuthInterface
{
    public function __construct(private ActivationCodeRepositoryInterface $activationCodeRepository) {}

    /** @throws Exception */
    public function handle(AuthDTO $dto, Closure $next): AuthDTO
    {
        $user = $dto->getUser();
        if ($user) {
            $code = $this->generateCode();

            /** @var ActivationCode $activationCode */
            $activationCode = $this->activationCodeRepository->store([
                'code'      => $code,
                'user_id'   => $user->id,
                'expire_at' => Carbon::now()->addMinutes(5),
            ]);
            $dto->setActivationCode($activationCode);
            $user->notify(new SendConfirmationCodeNotification($code));
        }

        return $next($dto);
    }

    /** @throws RandomException */
    private function generateCode(): int
    {
        $max = 10 ** 4; // code Length
        $min = $max / 10 - 1;

        return random_int($min, $max);
    }
}
