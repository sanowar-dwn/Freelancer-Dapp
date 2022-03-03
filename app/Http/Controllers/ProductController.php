<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class ProductController extends Controller
{
    function index(){
        $all_categories = Category::all();
        $all_subcategories = Subcategory::all();
        return view('admin.products.index',[
            'all_categories' => $all_categories,
            'all_subcategories' => $all_subcategories,
        ]);
    }

    function getCategory(Request $request){
        $sub_categories = Subcategory::where('category_id', $request->category_id)->get();
        $str_to_send = '<option>-- Select a category --</option>';
        foreach($sub_categories as $subcategory){
            $str_to_send .= '<option>'.$subcategory->subcategory_name.'</option>';
        }
        echo $str_to_send;
    }
}
