<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    function index(){
        $all_categories = Category::all();
        $all_subcategories = Subcategory::all();
        $all_products = Product::all();
        return view('admin.products.index',[
            'all_categories' => $all_categories,
            'all_subcategories' => $all_subcategories,
            'all_products' => $all_products,
        ]);
    }

    function getCategory(Request $request){
        $sub_categories = Subcategory::where('category_id', $request->category_id)->get();
        $str_to_send = '<option>-- Select a category --</option>';
        foreach($sub_categories as $subcategory){
            $str_to_send .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str_to_send;
    }

    function insert(Request $request){
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'discount' => $request->discount,
            'after_discount' => $request->product_price-($request->product_price*$request->discount/100),
            'brand' => $request->brand,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $image = $request->preview;
        $extension = $image->getClientOriginalExtension();
        $image_name = $product_id.'.'.$extension;

        Image::make($image)->resize(1200, 1200)->save(public_path('/uploads/product/'.$image_name));

        Product::find($product_id)->update([
            'preview' => $image_name,
        ]);

        return back();


    }
}
