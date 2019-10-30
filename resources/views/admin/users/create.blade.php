@extends('layouts.layout')

@section('title', 'Add user')

@section('content')
<!-- allows admins to create user accounts with the password set to password -->
<h4>Add Article</h4>
<hr>
{!! Form::open(array('route' => 'users.store', 'files' => true)) !!}
    <div class="form-group">
        <label class="">Name:</label>
        <input name="name" class="form-control input-lg" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label class="">Email:</label>
        <input name="email" class="form-control input-lg" value="{{ old('email') }}">
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Create User" name="status">
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    </div>
{!! Form::close() !!}

@endsection
