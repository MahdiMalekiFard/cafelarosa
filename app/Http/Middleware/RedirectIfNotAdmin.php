<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAdmin
{
    /** Handle an incoming request. */
    public function handle(Request $request, Closure $next): mixed
    {
        //        $roles = [RoleEnum::ADMIN->value];
        if (auth()->check()) {
            return $next($request);
            //            foreach (auth()->user()->getRoleNames() as $roleName) {
            //                if (in_array($roleName, $roles)) {
            //                    if (!auth()->user()->block) {
            //                        return $next($request);
            //                    } else {
            //                        auth()->logout();
            //                        return redirect(route('auth.login-view',['locale'=>app()->getLocale()]))->with(
            //                            'success',
            //                            'در حال حاضر امکان استفاده از پنل مدیریت میسر نمی باشد. لطفا برای بررسی این مشکل با بخش پشتیبانی تماس بگیرید.'
            //                        );
            //                    }
            //                }
            //            }
        }

        return redirect(route('auth.login-view', ['locale' => app()->getLocale()]));
    }
}
