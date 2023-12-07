<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5',
        ];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), [
            'email.required' => 'Enter Your Email Address',
            'email.email' => 'Invalid Email Address',
            'email.exists' => 'This Email is Not Registered in the Database',
            'password.required' => 'Password Is Required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withInput($request->all())
                ->withErrors($validator->errors()->messages());
        }

        $cred = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('web')->attempt($cred)) {
            $checkUser = User::where('email', $request->email)->first();

            if ($checkUser) {
                return redirect()->route('home.index');
            } else {
                return redirect()->route('login')->with('fail', 'Your Account does not exist');
            }
        } else {
            return redirect()->route('login')->with('fail', 'Incorrect Email or Password');
        }
    }


    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
