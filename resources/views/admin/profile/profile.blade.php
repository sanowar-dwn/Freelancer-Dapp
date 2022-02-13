@extends('layouts.dashboard')

@section('content')
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Update Name</div>
        <div class="card-body">
            <form action="{{ url('/profile/name_change') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="mt-2">
                    <label for="">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                </div>
                <div class="mt-2">
                    <button class="btn btn-success" type="submit">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection