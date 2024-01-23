<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AuthUserTrait;
use App\Traits\FIleUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Controller for handling Profile.
 * 
 * @author Hridoy
*/
class ProfileController extends Controller
{
    use AuthUserTrait, FIleUploadTrait;
    
    /**
     * Show Profile
     * 
     * @return \Illuminate\Contracts\View\View|Illuminate\Http\RedirectResponse
    */
    public function profile(): View|RedirectResponse
    {
        try{
            return view('profile.index', ['authUser' => $this->AuthUser()]);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Internal Server Error. ' . $e->getMessage());
        }
    }

    /**
     * Profile Update
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => ['required', 'regex:/^(\+88|88)?(01[3-9]\d{8})$/'], // Regex for Bangladeshi phone number
            'designation'   => 'nullable|max:255',
            'certification' => 'nullable|max:255',
            'nid'           => 'nullable|max:255',
            'passport'      => 'nullable|max:255',
            'avatar'        => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'       => 'nullable|max:255'
        ], [
            'phone.regex'   => 'The phone number must be a valid Bangladeshi phone number.',
        ]);

        try{
            $user = $this->AuthUser();

            $user->update($validatedData);

            # Delete old avatar and upload new avatar.
            if ($request->hasFile('avatar')) {
                $old_avatar = public_path(parse_url($user->avatar, PHP_URL_PATH));

                if (file_exists($old_avatar) && is_file($old_avatar)) unlink($old_avatar);

                $user->avatar = $this->FileUpload($validatedData->avatar, 'avatar', 'profile');
                $user->save();
            }

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Internal Server Error. ' . $e->getMessage());
        }
    }

    /**
     * Password Update
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'current_password' => 'required|min:6|max:32',
            'password'         => 'required|min:6|max:32|confirmed|different:current_password'
        ]);

        try{
            $user = $this->AuthUser();
            if (password_verify($validatedData['current_password'], $user->password)) {
                $user->update(['password' => bcrypt($validatedData['password'])]);
                return redirect()->back()->with('success', 'Password updated successfully.');
            }
            return redirect()->back()->with('error', 'The current password is incorrect.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Internal Server Error. ' . $e->getMessage());
        }
    }
}