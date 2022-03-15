<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    function master(){
        $all_categories = Category::all();
        return view('frontend.master',[
            'all_categories' => $all_categories,
        ]);
    }
    function index(){
        $all_categories = Category::all();
        return view('frontend.index',[
            'all_categories' => $all_categories,
        ]);
    }
}
