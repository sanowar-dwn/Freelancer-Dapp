<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    function index(){
        return view('admin.profile.profile');
    }

    function name_change(Request $request){
        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);
        return back();
    }

    function pass_change(Request $request){
        
    }
}
