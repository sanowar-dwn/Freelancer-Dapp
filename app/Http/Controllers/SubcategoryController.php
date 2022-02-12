<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;

class SubcategoryController extends Controller
{
    function index(){
        $categories = Category::all();
        $sub_categories = Subcategory::all();
        return view('admin.subcategory.index',[
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }

    function insert(Request $request){
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
