<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\datapengguna;
use App\Services\DatapenggunaService;


class ResetPasswordController extends Controller
{
    /**
     * Show the form for resetting the password.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    private $datapenggunaservice;

    public function __construct(DatapenggunaService $datapenggunaservice)
    {
        $this->datapenggunaservice = $datapenggunaservice;
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => request('email')
        ]);
    }

    /**
     * Handle a reset password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
    //    dd($request);
       $data = $this->datapenggunaservice->finduserbyemail($request->email);
       $data->update([
        'password' => Hash::make($request->password)
       ]);
       if($data){
        return redirect()->route('auth.view')->with('status', 'Password has been reset!');
       }else{
        return back()->withErrors(['email' => "gagal"]);

       }
    }



    /**
     * Get a validator for an incoming reset request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],  // Tambahkan panjang minimum password
            'token' => ['required'],
        ]);
    }
}
