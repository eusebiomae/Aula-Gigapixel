<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // /**
    //  * Handle an authentication attempt.
    //  *
    //  * @param  \Illuminate\Http\Request $request
    //  *
    //  * @return Response
    //  */
    function form(Request $request, $id = null) {
        return view('panel/login/form');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            // Authentication passed...

            return redirect()->intended('panel');
        } else {
            return "Usuario o Senha incorreta";

        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('panel/login');
    }
}
