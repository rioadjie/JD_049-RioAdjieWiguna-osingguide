<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectTo() . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended($this->redirectTo() . '?verified=1');
    }

    protected function redirectTo(): string
    {
        $role = auth()->user()->role;

        return match ($role) {
            'admin' => '/admin/dashboard',
            'guide' => '/guide/dashboard',
            'customer' => '/customer/dashboard',
            default => '/',
        };
    }
}
