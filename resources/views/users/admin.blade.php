@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Update Profile</li>
    </ol>
@endsection

@section('dynamic-content')
    <div class="container">
        <form action="{{ route('admin.users') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value="{{$user->id}}">
                <label for="name">User Name</label>
                <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ $user->name }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" id="email" name="email" value="{{ $user->email }}" disabled>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" type="password" id="confirm_password" name="confirm_password">
                @if ($errors->has('confirm_password'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('confirm_password') }}
                    </span>
                @endif
            </div>

            <div class="form-group mb-2 text-center">
                <button class="btn btn-primary btn-block" type="submit">
                    <i class="mdi mdi-content-save"></i> Submit
                </button>
            </div>
        </form>
    </div>
@endsection