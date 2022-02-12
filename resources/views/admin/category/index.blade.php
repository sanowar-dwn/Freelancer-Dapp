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
                            <td>Added By</td>
                            <td>Action</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($all_categories as $key => $category)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td><img class="w-25" src="{{ 'uploads/category' }}/{{ $category->category_image }}" alt=""></td>
                                <td>{{ App\Models\User::find($category->added_by)->name }}</td>    
                                <td><a href="{{ Route('category_edit',$category->id) }}" class="btn btn-info">EDIT</a></td>                            
                                <td><a href="{{ Route('category_delete',$category->id) }}" class="btn btn-danger">DELETE</a></td>                            
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Trashed Category List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Sl</td>
                            <td>Category</td>
                            <td>Category Image</td>
                            <td>Added By</td>
                            <td>Action</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($trashed_categories as $key => $category)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td><img class="w-25" src="{{ 'uploads/category' }}/{{ $category->category_image }}" alt=""></td>
                                <td>{{ App\Models\User::find($category->added_by)->name }}</td>    
                                <td><a href="{{ Route('category_restore',$category->id) }}" class="btn btn-info">RESTORE</a></td>                            
                                <td><a href="{{ Route('category_force_delete',$category->id) }}" class="btn btn-danger">DELETE</a></td>                            
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
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