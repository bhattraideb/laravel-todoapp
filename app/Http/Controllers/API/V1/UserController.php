<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $rules = [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];
        $validator  = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()],415);
        }
        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;

        $profile_image ='';
        if( $request->file('profile_image') ){
            $image          = $request->file('profile_image');
            $image_name     = str_replace(' ', '-', $image).'.'.$image->getClientOriginalExtension();
            $profile_image  = $image->storeAs('public/user', $image_name);
        }
        $user = User::create([
                'name' => $name,
                'email' => $email,
                'profile_image' => $profile_image,
                'password' => $password,
                'is_verified' => '1'
            ]);

        $token = $this->guard()->login($user);
        return $this->respondWithToken($token);
    }


    /**
     * API Login, on success return JWT Auth token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        if (! $token =  $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     * @param Request $request
     */
    public function logout() {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'status'        => 'success',
            'expires_in'   => $this->guard()->factory()->getTTL() * 60,
        ],200);
    }

    public function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }
}
