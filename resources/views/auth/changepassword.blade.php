@extends('admin-layouts.app')
@section('title','Change password')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
            <strong>Error</strong> An error occurred while updating password.

        </div>
        @endif
        <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
            <form method="POST" action="{{ route('change.password') }}">
                @csrf 

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label>Current Password&nbsp;<span class="color-red">*</span></label>
                            <input type="password" name="current_password" class="form-control" />
                            @error('current_password')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label>New Password&nbsp;<span class="color-red">*</span></label>
                            <input type="password" name="new_password"   class="form-control" />
                            @error('new_password')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label>Confirm Password&nbsp;<span class="color-red">*</span></label>
                            <input type="password"  name="confirm_password" class="form-control" />
                            @error('confirm_password')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <button type="submit" class="btn btn-medium btn-gold">Update Info</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection()