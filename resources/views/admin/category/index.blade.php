@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">ADD CATEGORY</div>
                <div class="card-body">
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
                            @error('category_image')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button type="submit"class="btn btn-success">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection