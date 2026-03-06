<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\DatapenggunaService;
use App\Http\Requests\StoreLogin;
use App\Http\Requests\StoreRegister;

class AuthApiController extends Controller
{
    private $datapenggunaservice;

    public function __construct(DatapenggunaService $datapenggunaservice)
    {
        $this->datapenggunaservice = $datapenggunaservice;
    }

    /**
     * API login method.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginMethod(StoreLogin $request)
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $data = $this->datapenggunaservice->findUserByEmail($request->email);
        if ($data && Hash::check($request->password, $data->password)) {
            $token = $data->createToken('auth_token')->plainTextToken;
            return response()->json([
                'data' => $data,
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }
    }

    /**
     * API register method.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerMethod(StoreRegister $request)
    {
        $user = $this->datapenggunaservice->createUser($request);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => $user,
            'message' => 'User successfully registered',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }

    /**
     * Logout method for API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutMethod()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logout successful']);
    }
}
