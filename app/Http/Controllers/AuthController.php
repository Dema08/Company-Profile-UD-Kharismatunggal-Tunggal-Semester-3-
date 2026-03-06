<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatapenggunaService;
use App\Http\Requests\StoreLogin;
use App\Http\Requests\StoreRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $datapenggunaservice;

    public function __construct(DatapenggunaService $datapenggunaservice)
    {
        $this->datapenggunaservice = $datapenggunaservice;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function loginMethod(StoreLogin $request)
    {

        $data = $this->datapenggunaservice->findUserByEmail($request->email);

        if ($data && Hash::check($request->password, $data->password)) {
            Auth::login($data);
            return $data->role == 'admin'
                ? redirect()->route('admin.dashboard.index')
                : redirect()->route('users.index');
        }

        return back()->withErrors(['email' => 'password atau email anda salah']);
    }

    public function registerMethod(StoreRegister $request)
    {

        $data = $this->datapenggunaservice->createUser($request);
        Auth::login($data);

        return redirect()->route('users.index');
    }
    public function forgotPasswordView()
    {
        return view('auth.forgot-password');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
