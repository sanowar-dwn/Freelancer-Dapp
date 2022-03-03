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
}
