<?php

namespace App\Helpers;

use Illuminate\Http\RedirectResponse;

class RedirectHelper
{
    /**
     * Redirect user based on their role
     *
     * @param mixed $user
     * @param string $fallback
     * @return RedirectResponse
     */
    public static function redirectByRole($user, string $fallback = '/'): RedirectResponse
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'guide') {
            return redirect()->route('guide.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect($fallback);
        }
    }

    /**
     * Get dashboard route by role
     *
     * @param mixed $user
     * @param string $fallback
     * @return string
     */
    public static function getDashboardRoute($user, string $fallback = '/'): string
    {
        if ($user->role === 'admin') {
            return route('admin.dashboard');
        } elseif ($user->role === 'guide') {
            return route('guide.dashboard');
        } elseif ($user->role === 'customer') {
            return route('customer.dashboard');
        } else {
            return $fallback;
        }
    }
}
