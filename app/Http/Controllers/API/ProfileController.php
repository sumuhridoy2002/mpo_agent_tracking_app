<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\AuthUserTrait;
use App\Traits\FIleUploadTrait;
use App\Traits\HttpResponse;
use App\Traits\UserResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller for handling user profile data show and update
 * 
 * @author Hridoy
 */
class ProfileController extends Controller
{
    use HttpResponse, UserResponseTrait, AuthUserTrait, FIleUploadTrait;

    /**
     * Get user's profile data
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function get_profile(Request $request) : JsonResponse
    {
        try {
            return $this->sendSuccess('User data fetched.', ['user' => $this->UserResponse($request->user())]);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Update user's profile data
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function update_profile(Request $request) : JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'name'          => 'required|string|max:255',
                'designation'   => 'required|string|max:255',
                'nid'           => 'nullable|string|max:255',
                'passport'      => 'nullable|string|max:255',
                'certification' => 'nullable|string|max:255',
                'address'       => 'nullable|string|max:255'
            ]);

            if($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            auth()->user()->update($validator->validated());

            return $this->sendSuccess('Profile updated successfully.', ['user' => $this->UserResponse(auth()->user())]);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Update user's profile avatar
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function update_avatar(Request $request) : JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = $this->authUser();

            # Delete old avatar and upload new avatar.
            $image = $validator->validated()['avatar'];

            if ($image) {
                $old_avatar = public_path(parse_url($user->avatar, PHP_URL_PATH));
                
                if (file_exists($old_avatar) && is_file($old_avatar)) unlink($old_avatar);

                $user->avatar = $this->FileUpload($image, 'avatar', 'profile');
                $user->save();
            }

            return $this->sendSuccess('Avatar updated successfully.', ['user' => $this->UserResponse(auth()->user())]);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Update user's profile nid
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function update_nid(Request $request) : JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'nid_pdf' => 'required|mimes:pdf|max:10240'
            ]);

            if($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = $this->authUser();

            # Delete old nid and upload new nid.
            $nid_pdf = $validator->validated()['nid_pdf'];

            if ($nid_pdf) {
                $old_nid = public_path(parse_url($user->nid_pdf, PHP_URL_PATH));
                
                if (file_exists($old_nid) && is_file($old_nid)) unlink($old_nid);

                $user->avatar = $this->FileUpload($nid_pdf, 'nid', 'profile');
                $user->save();
            }

            return $this->sendSuccess('NID updated successfully.', ['user' => $this->UserResponse(auth()->user())]);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Update user's profile passport
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function update_passport(Request $request) : JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'passport_pdf' => 'required|mimes:pdf|max:10240'
            ]);

            if($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = $this->authUser();

            # Delete old passport and upload new passport.
            $passport_pdf = $validator->validated()['passport_pdf'];

            if ($passport_pdf) {
                $old_passport = public_path(parse_url($user->passport_pdf, PHP_URL_PATH));
                
                if (file_exists($old_passport) && is_file($old_passport)) unlink($old_passport);

                $user->avatar = $this->FileUpload($passport_pdf, 'passport', 'profile');
                $user->save();
            }

            return $this->sendSuccess('Passport updated successfully.', ['user' => $this->UserResponse(auth()->user())]);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }
}