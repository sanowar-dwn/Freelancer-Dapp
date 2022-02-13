@extends('layouts.dashboard')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        <form action="{{ url('/category/update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-2">
                                <label for="">Category Name</label>
                                <input type="hidden" value="{{ $category_info -> id }}" class="form-control" name="id">
                                <input type="text" value="{{ $category_info -> category_name }}" name="category_name" class="form-control">
                            </div>
                            <div class="mt-2">
                                <label for="">Category Image</label>
                                <input type="file" name="category_image" class="form-control">
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-success" type="submit">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection