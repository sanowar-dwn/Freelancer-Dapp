<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function rel_to_product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function rel_to_color(){
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function rel_to_size(){
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
