<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
Use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logged_user = Auth::user()->name;
        $all_users = User::where('id', '!=', Auth::id())->paginate(10);
        return view('home',[
            'logged_user' => $logged_user,
            'all_users' => $all_users,
        ]);
    }

    function delete($user_id){
        User::find($user_id)->delete();
        return back()->with('delete', "User Deleted Successfully");
    }

    function dashboard(){
        return view('layouts.dashboard');
    }
}
