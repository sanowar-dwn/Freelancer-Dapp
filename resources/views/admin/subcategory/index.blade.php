@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Sub-Category List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Sl</td>
                            <td>Sub-Category</td>
                            <td>Parent-Category</td>
                            <td>Created At</td>
                        </tr>
                        @foreach ($sub_categories as $key => $subcategory)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->rel_to_cat->category_name }}</td>
                                <td>{{ $subcategory->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Sub Category</div>
                <div class="card-body">
                    <form action="{{ url('/subcategory/insert') }}" method="POST" enctype="multipart/form" class="form-horizontal">
                    @csrf
                    <div class="mt-2">
                        <select name="category_id" id="" class="form-control">
                            <option value="">--Select Parent Category--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="">Sub Category Name</label>
                        <input type="text" name="subcategory_name" class="form-control">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success">SUBMIT</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection