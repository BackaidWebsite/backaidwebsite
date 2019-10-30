@extends('layouts.layout')

@section('title',"Profile")

@section('content')
<!-- user profile settings page -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-offset-2">
            {!! Form::model($user, ['route' => ['profile.update', $user->userID], 'method' => 'PUT']) !!}
            <button class="btn btn-success" name="status" value="details" style="float:right;">Save</button>
            <h4>Account Settings</h4>
            <hr>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Name:</label>
                        <input  value="{{ $user->name }}" name="name" class="form-control input-lg">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Email:</label>
                        <input  value="{{ $user->email }}" name="email" class="form-control input-lg">
                    </div>
                </div>
            </div>
            {{ csrf_field() }}
            <hr>
            <h5>Change Password</h5>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Old Password:</label>
                        <input  type="password" name="oldPassword" class="form-control input-lg">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">New Password:</label>
                        <input id="password" type="password" class="form-control" name="password" >
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="">Confirm:</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" name="status" value="pass">Change Password</button>
            <hr>
        </div>
    </div>
</div>
@endsection
