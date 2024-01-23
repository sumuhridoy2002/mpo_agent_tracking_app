<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponse;
use App\Traits\SendOTP;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for handling user login and logout.
 *
 * @author Hridoy
 */
class AuthController extends Controller
{
    use HttpResponse, SendOTP;

    /**
     * Handle user login using Bangladesh phone number and password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'phone' => ['required', 'regex:/^(\+88|88)?(01[3-9]\d{8})$/'], // Regex for Bangladesh phone number
                'password' => ['required', 'min:6', 'max:32'],
            ], [
                'phone.regex' => 'The phone number must be a valid Bangladeshi phone number.',
            ]);

            if ($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = User::wherePhone($request->phone)->whereRole('Agent')->first();

            // Check if the user exists
            if ($user) {
                // Check the account status
                switch ($user->account_status) {
                    case 'Active':
                        // Attempt authentication
                        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                            // Generate and store OTP
                            $otp = $this->generateOTP();
                            $user->otp = $otp;
                            $user->save();

                            // Send OTP to the user (You need to implement this part)
                            if ($this->sendOTP($user->phone, $otp)) return $this->sendSuccess('OTP sent for verification.', ['user_id' => $user->id]);
                            return $this->sendError('Failed to send OTP. ', [], 500);
                        } else return $this->sendError('Invalid password.', [], 422);
                        break;
                    case 'Inactive':
                        return $this->sendError('Your account is inactive. Please contact support for assistance.', [], 422);
                        break;
                    case 'Banned':
                        return $this->sendError('Your account is banned. Please contact support for assistance.', [], 422);
                        break;
                    default:
                        return $this->sendError('Invalid account status.', [], 422);
                }
            }

            // If the user does not exist
            return $this->sendError('The provided phone number does not exist.', [], 404);
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Resend OTP to the user's phone.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendOTP(Request $request): JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = User::findOrFail($request->user_id);

            // Generate and store a new OTP
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $user->save();

            // Send the new OTP to the user (You need to implement this part)
            if ($this->sendOTP($user->phone, $otp)) return $this->sendSuccess('New OTP sent successfully.');

            return $this->sendError('Failed to send new OTP.', [], 500);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Verify OTP and log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOTP(Request $request): JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'user_id' => 'required|exists:users,id',
                'otp' => 'required|numeric|digits:4',
            ]);

            if ($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = User::findOrFail($request->user_id);

            if ($user && $user->otp == $request->otp) {
                // Clear the OTP after successful verification
                $user->otp = null;
                $user->phone_verified = true;
                $user->save();

                // Log in the user
                Auth::login($user);

                $token = $user->createToken('auth_token')->plainTextToken;
                return $this->sendSuccess('Login successful.', ['token' => $token]);
            }

            // If OTP is invalid
            return $this->sendError('Invalid OTP.', [], 422);
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();

            return $this->sendSuccess('Successfully logged out.');
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Generate a 4-digit OTP.
     *
     * @return int
     */
    private function generateOTP(): int
    {
        return mt_rand(1000, 9999);
    }

    /**
     * Initiate the forgot password process with OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'phone' => ['required', 'regex:/^(\+88|88)?(01[3-9]\d{8})$/'], // Regex for Bangladesh phone number
            ], [
                'phone.regex' => 'The phone number must be a valid Bangladeshi phone number.',
            ]);

            if ($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = User::wherePhone($request->phone)->whereRole('Agent')->first();

            if ($user) {
                // Generate and store OTP
                $otp = $this->generateOTP();
                $user->otp = $otp;
                $user->save();

                // Send OTP to the user (You need to implement this part)
                if ($this->sendOTP($user->phone, $otp)) return $this->sendSuccess('OTP sent for password reset.', ['user_id' => $user->id]);

                return $this->sendError('Failed to send OTP.', [], 500);
            }

            return $this->sendError('User not found with the provided phone number.', [], 404);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Match the OTP to reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPasswordOTPMatch(Request $request): JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'user_id' => 'required|exists:users,id',
                'otp' => 'required|numeric|digits:4'
            ]);

            if ($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = User::findOrFail($request->user_id);

            if ($user && $user->otp == $request->otp) {
                // Reset the new OTP after successful matched OTP
                $otp = $this->generateOTP();
                $user->otp = $otp;
                $user->save();
                return $this->sendSuccess('OTP matched successfully.', ['user_id' => $user->id, 'reset_otp' => $otp]);
            }

            // If OTP is invalid
            return $this->sendError('Invalid OTP.', [], 422);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Reset the user's password with OTP verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse
    {
        try {
            $validator = validator($request->all(), [
                'user_id' => 'required|exists:users,id',
                'otp' => 'required|numeric|digits:4',
                'password' => 'required|min:6|max:32'
            ]);

            if ($validator->fails()) return $this->sendError('Validation error.', $validator->errors(), 422);

            $user = User::findOrFail($request->user_id);

            if ($user && $user->otp == $request->otp) {
                // Clear the OTP after successful verification
                $user->otp = null;
                $user->password = bcrypt($request->password); // Update the password
                $user->phone_verified = true;
                $user->save();

                // Log in the user
                Auth::login($user);

                $token = $user->createToken('auth_token')->plainTextToken;
                return $this->sendSuccess('Password reset successfully.', ['token' => $token]);
            }

            // If OTP is invalid
            return $this->sendError('Invalid OTP.', [], 422);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }
}