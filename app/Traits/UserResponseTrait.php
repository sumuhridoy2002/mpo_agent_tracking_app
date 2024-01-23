<?php

namespace App\Traits;

use App\Models\User;

/**
 * Trait for handling User response.
 *
 * @author Hridoy
 */
trait UserResponseTrait
{
    /**
     * Send User Response.
     *
     * @param App\Models\User $user
     *
     * @return array
     */
    protected function UserResponse(User $user): array
    {
        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'designation' => $user->designation ?? '',
            'nid' => $user->nid ?? '',
            'nid_pdf' => $user->nid_pdf ? asset($user->nid_pdf) : '',
            'passport' => $user->passport ?? '',
            'passport_pdf' => $user->passport_pdf ? asset($user->passport_pdf) : '',
            'certification' => $user->certification ?? '',
            'address' => $user->address ?? '',
            'avatar' => $user->avatar ? asset($user->avatar) : asset('assets/img/profile-img.jpg')
        ];
    }
}