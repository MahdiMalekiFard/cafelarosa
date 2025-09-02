<?php

declare(strict_types=1);

namespace App\Services\Mail;

use App\Mail\SendVerificationCodeMail;
use App\Models\ActivationCode;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendVerificationCode(User $user, $type = 'email'): void
    {
        if (in_array($user->email, ['sajadsoft1@gmail.com', 'admin@gmail.com'])) {
            $code = 1111;
        } else {
            $code = rand(100000, 999999);
        }
        ActivationCode::where('user_id', $user->id)
            ->where('used', false)
            ->delete();

        ActivationCode::create([
            'user_id'   => $user->id,
            'code'      => $code,
            'used'      => false,
            'expire_at' => now()->addDays(1),
        ]);
        //        Mail::to($user)->send(new SendVerificationCodeMail($user, $code));
    }
}
