<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        if ($request->session()->get('username')) {
            return redirect('/todoList');
        }else {
            return redirect('/login')->with('error', 'login required!');
        }
    }
}
