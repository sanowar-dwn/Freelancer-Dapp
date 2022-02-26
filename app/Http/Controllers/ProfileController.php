<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Image;

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

    function photo_change(Request $request){
        $profile_photo = $request->profile_photo;

        if(Auth::user()->profile_photo != 'default.png'){
            $path = public_path('/uploads/profile/'.Auth::user()->profile_photo);
            unlink($path);

            $extension = $profile_photo->GetClientOriginalExtension();
            $profile_photo_name = Auth::id().'.'.$extension;

            Image::make($profile_photo)->save(public_path('/uploads/profile/'.$profile_photo_name));

            User::find(Auth::id())->update([
                'profile_photo' => $profile_photo_name,
            ]);
            return back();
        }
        else{
            $extension = $profile_photo->GetClientOriginalExtension();
            $profile_photo_name = Auth::id() . '.' . $extension;

            Image::make($profile_photo)->save(public_path('/uploads/profile' . $profile_photo_name));

            User::find(Auth::id())->update([
                'profile_photo' => $profile_photo_name,
            ]);
            return back();
        }
    }
}
