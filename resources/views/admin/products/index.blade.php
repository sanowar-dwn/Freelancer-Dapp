@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">All Products</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Sl</td>
                                <td>Product Name</td>
                                <td>Price</td>
                                <td>After Discount Price</td>
                                <td>Brand</td>
                                <td>Image</td>
                            </tr>
                            @foreach ($all_products as $key=> $product) 
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->after_discount }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td><img class="w-50" src="{{ asset('uploads/product') }}/{{ $product->preview }}" alt=""></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">ADD PRODUCT</div>
                    <div class="card-body">
                        <form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <select name="category_id" class="form-control" id="category_id">
                                    <option>-- Select Category --</option>
                                    @foreach ($all_categories as $category) 
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="subcategory_name" name="subcategory_id" class="form-control">
                                    <option value="">-- Select Sub Category --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Product Price</label>
                                <input type="number" name="product_price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Discount %</label>
                                <input type="number" name="discount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Brand</label>
                                <input type="text" name="brand" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Preview Image</label>
                                <input type="file" name="preview" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">ADD PRODUCT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_script')
    <script>
        $('#category_id').change(function(){
            var category_id = $(this).val();
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'POST',
                url: 'getCategory',
                data: {'category_id' : category_id},
                success:function(data){
                    $('#subcategory_name').html(data);
                }
            });
        })
    </script>
@endsection