<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, HttpResponse;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "phone" => "required|max:14",
            "password" => "required|min:6|max:15",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors()->toArray(), 422);
        }

        try {
            $inputs = [
                "name"  =>  $request->name,
                "email"  =>  $request->email,
                "phone" => $request->phone,
                "designation" => $request->designation,
                "image" => $request->image,
                "nid" => $request->nid,
                "passport" => $request->passport,
                "address" => $request->address,
                "password" => Hash::make($request->password),
            ];

            $user = User::create($inputs);

            $response = [
                "auth_user" => $user
            ];

            return $this->sendSuccess("Signup success", $response);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
}
