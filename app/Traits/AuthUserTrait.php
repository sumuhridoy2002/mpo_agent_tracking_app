<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Trait for handling User response.
 *
 * @author Hridoy
 */
trait AuthUserTrait
{
    /**
     * Send OTP.
     *
     * @param App\Models\User $user
     *
     * @return Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function AuthUser(): Authenticatable|null
    {
        return auth()->user();
    }
}