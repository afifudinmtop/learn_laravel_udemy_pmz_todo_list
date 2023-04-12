<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function display(Request $request)
    {
        $user_id = $request->session()->get('user_id');

        // list_todo on database
        $list_todo = DB::table('todo')
                        ->where('user_id', '=', $user_id)
                        ->where('hapus', '=', null)
                        ->get();

        // return $list_todo;
        return view('todoList/todoList', ['list_todo' => $list_todo]);
    }
    
    public function create(Request $request)
    {
        // validasi
        $validated = $request->validate([
            'todo' => 'required',
        ]);

        // assign variable
        $todo = $request->input('todo');
        $user_id = $request->session()->get('user_id');

        // add to database
        DB::table('todo')->insert([
            'todo' => $todo,
            'user_id' => $user_id
        ]);

        return back()->with('success', 'todo added!');
    }

    public function delete(Request $request)
    {
        // assign variable
        $id = $request->input('id');
        $user_id = $request->session()->get('user_id');

        // cek database
        $cek = DB::table('todo')
                        ->where('id', '=', $id)
                        ->where('user_id', '=', $user_id)
                        ->count();

        // kalo bukan owner nya
        if ($cek == 0) {
            return back()->with('error', 'invalid auth!');
        }

        // update database
        DB::table('todo')
            ->where('id', $id)
            ->update(['hapus' => 'hapus']);

        return back()->with('success', 'todo deleted!');
    }
}
