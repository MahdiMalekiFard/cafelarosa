<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyCodeAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}
    
    /** VerifyCode .... */
    public function handle(array $payload = []): RedirectResponse
    {
        /** @var User|null $user */
        $user = $this->userRepository->find($payload['user_id'], 'id');
        if ($user) {
            $activationCode = ActivationCode::where('code', Arr::get($payload, 'code'))
                ->where('user_id', Arr::get($payload, 'user_id'))
                ->where('used', false)
                ->first();
            if ($activationCode) {
                $user->profile()->update([
                    'email_verify_at' => now(),
                ]);
                $activationCode->delete();
                auth()->login($user, true);

                return redirect()->intended(route('index'));
            }
        }

        return redirect()->back()->withToastError(__('auth.wrong_code'));
    }
}
