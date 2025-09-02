<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\VerifyCodeAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Pipelines\Auth\AuthDTO;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseWebController
{
    public function loginView(): View|RedirectResponse
    {
        if (auth()->user()) {
            return redirect(route('index'));
        }

        if (!session()?->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request): ?RedirectResponse
    {
        try {
            /** @var AuthDTO $dto */
            $dto = LoginAction::run($request->validated());
            auth()->login($dto->getUser(), true);

            return redirect()->route('admin.index');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());

            return redirect()->back()->withToastError($exception->getMessage());
        }
    }

    public function forgotPasswordView()
    {
        return view('auth.forgot-password');
    }

    public function verifyCodeView()
    {
        return view('auth.verify-email');
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        return VerifyCodeAction::run($request->validated());
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('index');
    }
}
