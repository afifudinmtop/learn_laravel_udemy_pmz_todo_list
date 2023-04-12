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

        // user_id on database
        $user_id = DB::table('user')
                        ->where('username', '=', $username)
                        ->limit(1)
                        ->get();

        // store data di session
        if ($cek) {
            $request->session()->put('username', $username);
            $request->session()->put('user_id', $user_id[0]->id);
            return redirect('/');
        }
        
        // kalo user not found
        return back()->with('error', 'invalid username / password!');
    }

    public function doLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
