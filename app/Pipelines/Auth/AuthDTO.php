<?php

declare(strict_types=1);

namespace App\Pipelines\Auth;

use App\Models\ActivationCode;
use App\Models\User;
use App\Traits\HasPayload;

class AuthDTO
{
    use HasPayload;

    private ?User $user                     = null;
    private ?ActivationCode $activationCode = null;
    private ?string $token                  = null;

    public function __construct($payload = [])
    {
        $this->payload = $payload;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function userRequestWithEmailOrMobile(): string
    {
        return $this->getFromPayload('email') ? 'email' : 'mobile';
    }

    public function getActivationCode(): ?ActivationCode
    {
        return $this->activationCode;
    }

    public function setActivationCode(?ActivationCode $activationCode): void
    {
        $this->activationCode = $activationCode;
    }
}
