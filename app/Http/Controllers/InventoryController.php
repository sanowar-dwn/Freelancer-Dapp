<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Inventory;
use Carbon\Carbon;

class InventoryController extends Controller
{
    function index($product_id){
        $all_colors = Color::all();
        $all_sizes = Size::all();
        $product_id = Product::find($product_id);
        $all_inventories = Inventory::all();
        return view('admin.inventory.index',[
            'all_colors' => $all_colors,
            'all_sizes' => $all_sizes,
            'product_id' => $product_id,
            'all_inventories' => $all_inventories,
        ]);
    }

    function color(){
        return view('admin.color.index');
    }
    
    function color_insert(Request $request){
        Color::insert([
            'color_name' => $request->color_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function size(){
        return view('admin.size.index');
    }
    function size_insert(Request $request){
        Size::insert([
            'size' => $request->size,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function inventory_insert(Request $request){
        Inventory::insert([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' =>Carbon::now(),
        ]);
        return back();
    }
}
