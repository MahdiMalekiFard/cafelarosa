<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Blog;
use App\Models\User;

class GetReference
{
    public static function reference(string $reference): ?string
    {
        $reference = str_replace('\\', '/', $reference);
        return basename($reference);
        //        return match ($reference) {
        //            User::class => 'User',
        //            Blog::class => 'Blog',
        //            default     => 'reference not find',
        //        };
    }
}
