<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    //Category list and form page
    function index(){
        $all_categories = Category::all();
        $trashed_categories = Category::onlyTrashed()->get();
        return view('admin.category.index',[
            'all_categories' => $all_categories,
            'trashed_categories' => $trashed_categories,
        ]);
    }

    //Category Insert 
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
        return back();
    }

    //Category edit
    function edit($cat_id){
        $category_info = Category::find($cat_id);
        return view('admin.category.edit',[
            'category_info' => $category_info,
        ]);
    }

    //Category Update 
    function update(Request $request){
        Category::find($request -> id)->update([
            'category_name'=>$request->category_name,
        ]);
        return back();
    }

    //Category Delete
    function delete($cat_id)
    {
        Category::find($cat_id)->delete();
        return back()->with('cat_trash',
            "Category moved to trash"
        );
    }

    //Category Restore 

    function restore($cat_id){
        Category::onlyTrashed()->find($cat_id)->restore();
        return back();
    }

    //Category force delete

    function force_delete($cat_id){
        Category::onlyTrashed()->find($cat_id)->forcedelete();
        return back();
    }
}
