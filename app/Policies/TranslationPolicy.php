<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Translation;
use App\Models\User;

class TranslationPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Translation $translation): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Translation $translation): bool
    {
        return true;
    }

    public function delete(User $user, Translation $translation): bool
    {
        return true;
    }

    public function restore(User $user, Translation $translation): bool
    {
        return true;
    }

    public function forceDelete(User $user, Translation $translation): bool
    {
        return true;
    }
}
