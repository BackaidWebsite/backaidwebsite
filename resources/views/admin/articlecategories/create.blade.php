@extends('layouts.layout')

@section('title',"Add Category")

@section('content')
<!--Create Article Category -->
<h4>Add Category</h4>
<hr>

<div class="form-group">
    {!! Form::open(array('route' => 'articlecategories.store', 'files' => true)) !!}
    <div class="form-group">
        <label class="form-spacing-top">Category:</label>
        <input class="form-control input-lg" name="category" value="{{ old('category') }}">
        {{ csrf_field() }}
    </div>
        <button class="btn btn-success" type="submit">Add New Category</button>
        <button value="back" name="status" class="btn btn-danger ">Cancel</button>
    {!! Form::close() !!}
</div>


@endsection
