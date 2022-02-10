<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
Use App\Models\Category;
use Auth;
use Image;

class CategoryController extends Controller
{
    function index(){
        $all_categories = Category::all();
        return view('admin.category.index',[
            'all_categories' => $all_categories,
        ]);
    }

    function insert(CategoryRequest $request){
        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        $category_image = $request->category_image;
        $extension = $category_image->GetClientOriginalExtension();
        $category_image_name = $category_id.'.'.$extension;
        
        Image::make($category_image)->resize(300,300)->save(public_path('uploads/category/'.$category_image_name));

        Category::find($category_id)->update([
            'category_image' => $category_image_name,
        ]);
        return back()->with('category_insert_success', 'Category inserted successfully');
    }

    function edit($cat_id){
        $category_info = Category::find($cat_id);
        return view('admin.category.edit',[
            'category_info' => $category_info,
        ]);
    }
}
