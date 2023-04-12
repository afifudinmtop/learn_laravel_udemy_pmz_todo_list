<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login()
    {
        return view('user/login', [
            'title' => "Login"
        ]);
    }

    public function doLogin(Request $request)
    {
        
        // validasi
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // assign variable
        $username = $request->input('username');
        $password = $request->input('password');

        // cek database
        $cek = DB::table('user')
                        ->where('username', '=', $username)
                        ->where('password', '=', $password)
                        ->count();

        // store data di session
        if ($cek) {
            $request->session()->put('username', $username);
            return redirect('/');
        }
        
        // kalo user not found
        return back()->with('error', 'invalid username / password!');
    }

    public function doLogout()
    {
        $request->session()->flush();
        return redirect('/');
    }
}
