<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password' => Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),
            'password_confirmation' => 'required',
        ]);
        if(Hash::check($request->old_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password' => bcrypt($request->password),
            ]);
        }
        else{
            return back()->with('password_error', 'You have entered an incorrect password');
        }
    }
}
