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
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Update Password</div>
        <div class="card-body">
            <form action="{{ url('/profile/pass_change') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="mt-2">
                    <label for="">Old Password</label>
                    <input type="password" name="old_password" class="form-control">
                    @error('old_password')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="">New Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="">Confirm new password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mt-2">
                    <button class="btn btn-success" type="submit">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection