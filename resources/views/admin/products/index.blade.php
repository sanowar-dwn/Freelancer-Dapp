@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">ADD PRODUCT</div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form">
                            @csrf
                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                    <option>-- Select Category --</option>
                                    @foreach ($all_categories as $category) 
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="subcategory_id" class="form-control">
                                    <option>-- Select Sub Category --</option>
                                    @foreach ($all_subcategories as $subcategory) 
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Product Price</label>
                                <input type="text" name="product_price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Discount %</label>
                                <input type="number" name="discount_price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Brand</label>
                                <input type="number" name="discount_price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">ADD PRODUCT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection