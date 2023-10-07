<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'name'  => ['required'],
            'email' => ['required', 'email', 'unique:users,email,id'],
            'password' => ['required'],
        ]);

        if ($validate->fails()) {
            return respons(false, $validate->errors()->first(), [], 422);
        }

        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_name' => 'Member'
            ]);

            return respons(true, 'Register Berhasil, Silakan login dengan email '.$request->email, [], 200);

        } catch (\Throwable $th) {
            return respons(false, $th->getMessage(), [], 500);
        }
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($validate->fails()) {
            return respons(false, $validate->errors()->first(), [], 422);
        }

        // check login apakah valid atau tidak valid
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) return respons(false, 'Email atau Password Salah', [], 400);

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('token_api')->plainTextToken;

        $data = [
            'user'  => $user->toArray(),
            'token' => $token,
        ];

        return respons(true, 'Login Berhasil', $data, 200);
    }
}
