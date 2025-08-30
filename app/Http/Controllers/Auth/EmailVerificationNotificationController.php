<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectTo());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
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
