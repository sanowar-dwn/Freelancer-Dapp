@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Size</div>
                <div class="card-body">
                    <form action="{{ url('/inventory/size/insert') }}" method="POST">
                        @csrf
                        <div class="mt-2">
                            <label for="">Size</label>
                            <input type="text" name="size" class="form-control">
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-success">ADD SIZE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection