<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function index(){
        return view('admin.category.index');
    }

    function insert(CategoryRequest $request){
        Category::insert([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
