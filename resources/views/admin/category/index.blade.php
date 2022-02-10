@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Category List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Sl</td>
                            <td>Category</td>
                            <td>Category Image</td>
                            <td>Created At</td>
                        </tr>
                        @foreach ($all_categories as $key => $category)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td><img class="w-25" src="{{ asset('uploads/category/') }}/{{ $category->category_image }}" alt=""></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    @if (session('category_insert_success'))
                        <div class="alert alert-success">{{ session('category_insert_success') }}</div>
                    @endif
                    <form action="{{ url('/category/insert') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-2">
                            <label for="">Category Name</label>
                            <input type="text" name="category_name" class="form-control">
                            @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Category Image</label>
                            <input type="file" name="category_image" class="form-control">
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-success"> ADD CATEGORY </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection