@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <card class="card-header">All Inventory of </card>
            <div class="card-body">
                <table class="table table-striped ">
                    <tr>
                        <td>Sl</td>
                        <td>Product</td>
                        <td>Color</td>
                        <td>Size</td>
                        <td>Quantity</td>
                    </tr>
                    @foreach ($all_inventories as $key=>$inventory )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $inventory->rel_to_product->product_name }}</td>
                            <td>{{ $inventory->rel_to_color->color_name }}</td>
                            <td>{{ $inventory->rel_to_size->size }}</td>
                            <td>{{ $inventory->quantity }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Inventory</div>
                <div class="card-body">
                    <form action="{{ url('/inventory/insert') }}" method="POST">
                        @csrf
                        <div class="mt-2">
                            <label for="">Product Name</label>
                        <input type="text" readonly value="{{ $product_id->product_name }}" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="">Color</label>
                            <input type="hidden" value="{{ $product_id->id }}" name="product_id">
                            <select name="color_id" class="form-control">
                                <option>-- Select a Color</option>
                                @foreach ($all_colors as $color) 
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="">Size</label>
                            <select name="size_id" class="form-control">
                                <option>-- Select a Size</option>
                                @foreach ($all_sizes as $size) 
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success">ADD INVENTORY</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection