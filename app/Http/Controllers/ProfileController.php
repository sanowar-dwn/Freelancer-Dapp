<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
            ->symbols()
            ->uncompromised(),
            'password_confirmation' => 'required',
        ]);
    }
}
